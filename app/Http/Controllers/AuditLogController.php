<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display audit logs.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')
            ->latest();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('module', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")

                    ->orWhereHas('user', function ($user) use ($search) {

                        $user->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filter by module
        |--------------------------------------------------------------------------
        */

        if ($request->filled('module')) {

            $query->where(
                'module',
                $request->module
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filter by action
        |--------------------------------------------------------------------------
        */

        if ($request->filled('action')) {

            $query->where(
                'action',
                $request->action
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $logs = $query
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalLogs = AuditLog::count();

        $todayLogs = AuditLog::whereDate(
            'created_at',
            today()
        )->count();

        $userActions = AuditLog::whereNotNull(
            'user_id'
        )->count();

        $modules = AuditLog::whereNotNull('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        $actions = AuditLog::whereNotNull('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view(
            'audit-logs.index',
            compact(
                'logs',
                'totalLogs',
                'todayLogs',
                'userActions',
                'modules',
                'actions'
            )
        );
    }


    /**
     * Delete a single audit log.
     */
    public function destroy(AuditLog $auditLog)
    {
        $auditLog->delete();

        return redirect()
            ->route('audit-logs.index')
            ->with(
                'success',
                'Audit log deleted successfully.'
            );
    }


    /**
     * Delete all audit logs.
     */
    public function destroyAll()
    {
        AuditLog::truncate();

        return redirect()
            ->route('audit-logs.index')
            ->with(
                'success',
                'All audit logs cleared successfully.'
            );
    }
}