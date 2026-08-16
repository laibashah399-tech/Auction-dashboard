<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuditLogService
{
    /**
     * Create an audit log.
     */
    public static function log(
        string $action,
        string $module,
        string $description,
        ?Model $model = null,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        try {

            $user = Auth::user();

            AuditLog::create([
                'user_id' => $user?->id,

                'user_name' => $user?->name ?? 'System',

                'action' => $action,

                'module' => $module,

                'description' => $description,

                'ip_address' => request()->ip(),

                'method' => request()->method(),

                'url' => request()->fullUrl(),

                'old_values' => $oldValues,

                'new_values' => $newValues,
            ]);

        } catch (Throwable $e) {

            /*
             * Audit logging should never
             * break the main application.
             */

            report($e);
        }
    }


    /**
     * Log created record.
     */
    public static function created(
        string $module,
        Model $model,
        string $description
    ): void {

        self::log(
            'created',
            $module,
            $description,
            $model,
            null,
            self::cleanValues($model->getAttributes())
        );
    }


    /**
     * Log updated record.
     */
    public static function updated(
        string $module,
        Model $model,
        string $description
    ): void {

        self::log(
            'updated',
            $module,
            $description,
            $model,
            self::cleanValues($model->getOriginal()),
            self::cleanValues($model->getAttributes())
        );
    }


    /**
     * Log deleted record.
     */
    public static function deleted(
        string $module,
        Model $model,
        string $description
    ): void {

        self::log(
            'deleted',
            $module,
            $description,
            $model,
            self::cleanValues($model->getAttributes()),
            null
        );
    }


    /**
     * Remove sensitive information.
     */
    protected static function cleanValues(array $values): array
    {
        unset(
            $values['password'],
            $values['remember_token'],
            $values['two_factor_secret'],
            $values['two_factor_recovery_codes']
        );

        return $values;
    }
}