@extends('layouts.app')

@section('title', 'Users & Roles - AuctionPro')

@section('page-heading', 'Users & Roles')

@section('page-description', 'Manage system users and their access roles.')

@section('content')

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Users & Roles
            </h2>

            <p class="text-gray-500 mt-1">
                Manage system users and their access roles.
            </p>
        </div>

        <a href="{{ route('users.create') }}"
           class="flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">

            <i data-lucide="plus" class="w-4 h-4"></i>

            Add User

        </a>

    </div>


    <!-- STATISTICS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


        <!-- TOTAL USERS -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Users
                    </p>

                    <h3 class="text-3xl font-bold mt-2">
                        {{ $totalUsers }}
                    </h3>

                </div>

                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center">

                    <i data-lucide="users" class="w-6 h-6"></i>

                </div>

            </div>

        </div>


        <!-- ADMINISTRATORS -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        Administrators
                    </p>

                    <h3 class="text-3xl font-bold mt-2">
                        {{ $adminUsers }}
                    </h3>

                </div>

                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center">

                    <i data-lucide="shield-check" class="w-6 h-6"></i>

                </div>

            </div>

        </div>


        <!-- MANAGERS -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        Managers
                    </p>

                    <h3 class="text-3xl font-bold mt-2">
                        {{ $managerUsers }}
                    </h3>

                </div>

                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center">

                    <i data-lucide="briefcase-business" class="w-6 h-6"></i>

                </div>

            </div>

        </div>


        <!-- STAFF -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-gray-500">
                        Staff
                    </p>

                    <h3 class="text-3xl font-bold mt-2">
                        {{ $staffUsers }}
                    </h3>

                </div>

                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">

                    <i data-lucide="user-check" class="w-6 h-6"></i>

                </div>

            </div>

        </div>

    </div>


    <!-- FILTER -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6">

        <form method="GET" action="{{ route('users.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                <!-- SEARCH -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Name or email..."
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                    >

                </div>


                <!-- ROLE -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500"
                    >

                        <option value="">
                            All Roles
                        </option>

                        <option value="Admin"
                            {{ request('role') == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Manager"
                            {{ request('role') == 'Manager' ? 'selected' : '' }}>
                            Manager
                        </option>

                        <option value="Staff"
                            {{ request('role') == 'Staff' ? 'selected' : '' }}>
                            Staff
                        </option>

                    </select>

                </div>


                <!-- BUTTONS -->
                <div class="flex items-end gap-2">

                    <button
                        type="submit"
                        class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700"
                    >

                        <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>

                        Filter

                    </button>


                    <a
                        href="{{ route('users.index') }}"
                        class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200"
                    >

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    <!-- USERS TABLE -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">


        <!-- TABLE HEADER -->
        <div class="p-6 border-b border-gray-100">

            <h3 class="text-lg font-bold">
                System Users
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Manage users who have access to AuctionPro.
            </p>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                            User
                        </th>

                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                            Email
                        </th>

                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                            Role
                        </th>

                        <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                            Joined
                        </th>

                        <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">


                    @forelse($users as $user)

                        <tr class="hover:bg-gray-50 transition">


                            <!-- USER -->
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-semibold">

                                        {{ strtoupper(substr($user->name, 0, 2)) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-gray-900">
                                            {{ $user->name }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <!-- EMAIL -->
                            <td class="px-6 py-4 text-sm text-gray-600">

                                {{ $user->email }}

                            </td>


                            <!-- ROLE -->
                            <td class="px-6 py-4">

                                @if($user->role === 'Admin')

                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-medium">

                                        <i data-lucide="shield-check" class="w-3 h-3"></i>

                                        Admin

                                    </span>

                                @elseif($user->role === 'Manager')

                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-medium">

                                        <i data-lucide="briefcase-business" class="w-3 h-3"></i>

                                        Manager

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-medium">

                                        <i data-lucide="user-check" class="w-3 h-3"></i>

                                        Staff

                                    </span>

                                @endif

                            </td>


                            <!-- DATE -->
                            <td class="px-6 py-4 text-sm text-gray-500">

                                {{ $user->created_at?->format('d M Y') }}

                            </td>


                            <!-- ACTIONS -->
                            <td class="px-6 py-4">

                                <div class="flex items-center justify-end gap-2">


                                    <!-- VIEW -->
                                    <a
                                        href="{{ route('users.show', $user) }}"
                                        title="View User"
                                        class="p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 transition"
                                    >

                                        <i data-lucide="eye" class="w-5 h-5"></i>

                                    </a>


                                    <!-- EDIT -->
                                    <a
                                        href="{{ route('users.edit', $user) }}"
                                        title="Edit User"
                                        class="p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition"
                                    >

                                        <i data-lucide="edit" class="w-5 h-5"></i>

                                    </a>


                                    <!-- DELETE -->
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete User"
                                            class="p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-red-50 transition"
                                        >

                                            <i data-lucide="trash-2" class="w-5 h-5"></i>

                                        </button>

                                    </form>


                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mb-3">

                                        <i data-lucide="users"
                                           class="w-7 h-7 text-gray-400">
                                        </i>

                                    </div>

                                    <p class="font-medium text-gray-700">
                                        No users found
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Add your first system user.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse


                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->
        @if($users->hasPages())

            <div class="px-6 py-4 border-t border-gray-100">

                {{ $users->links() }}

            </div>

        @endif


    </div>

@endsection