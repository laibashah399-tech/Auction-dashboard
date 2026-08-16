<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalUsers = User::count();

        $adminUsers = User::where('role', 'Admin')->count();

        $managerUsers = User::where('role', 'Manager')->count();

        $staffUsers = User::where('role', 'Staff')->count();

        return view('users.index', compact(
            'users',
            'totalUsers',
            'adminUsers',
            'managerUsers',
            'staffUsers'
        ));
    }

    /**
     * Show create user form.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'role' => [
                'required',
                'string',
                'in:Admin,Manager,Staff',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],

            'email' => $validated['email'],

            'role' => $validated['role'],

            'password' => Hash::make($validated['password']),
        ]);


        // ==========================================
        // AUTOMATIC ADMIN NOTIFICATION
        // ==========================================

        $admins = User::where('role', 'Admin')
            ->where('id', '!=', $user->id)
            ->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new SystemNotification(
                    'New User Created',
                    'A new ' .
                    $user->role .
                    ' user "' .
                    $user->name .
                    '" has been created.',
                    'user'
                )
            );
        }


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User created successfully.'
            );
    }

    /**
     * Display a specific user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show edit form.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'role' => [
                'required',
                'string',
                'in:Admin,Manager,Staff',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        // Store old values for notification
        $oldName = $user->name;
        $oldRole = $user->role;


        // Update user
        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->role = $validated['role'];


        // Only update password if entered
        if (!empty($validated['password'])) {
            $user->password = Hash::make(
                $validated['password']
            );
        }

        $user->save();


        // ==========================================
        // AUTOMATIC ADMIN NOTIFICATION
        // ==========================================

        $admins = User::where('role', 'Admin')
            ->where('id', '!=', $user->id)
            ->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new SystemNotification(
                    'User Updated',
                    'User "' .
                    $user->name .
                    '" has been updated successfully.',
                    'user'
                )
            );
        }


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    /**
     * Delete user.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the currently logged-in user
        if (auth()->check() && auth()->id() === $user->id) {

            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'You cannot delete your own account.'
                );
        }


        // Store user information before deletion
        $deletedUserName = $user->name;

        $deletedUserRole = $user->role;


        // Delete user
        $user->delete();


        // ==========================================
        // AUTOMATIC ADMIN NOTIFICATION
        // ==========================================

        $admins = User::where('role', 'Admin')->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new SystemNotification(
                    'User Deleted',
                    'User "' .
                    $deletedUserName .
                    '" (' .
                    $deletedUserRole .
                    ') has been deleted.',
                    'user'
                )
            );
        }


        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}