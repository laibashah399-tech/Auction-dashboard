<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users & Roles - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        sidebar: '#111827',
                    }
                }
            }
        }
    </script>

</head>


<body class="bg-gray-100 text-gray-800">


<div class="flex min-h-screen">


    <!-- ========================= -->
    <!-- SIDEBAR -->
    <!-- ========================= -->

    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300">


        <!-- Logo -->

        <div class="h-20 flex items-center px-6 border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center mr-3">

                <i data-lucide="gavel" class="w-6 h-6"></i>

            </div>

            <div>

                <h1 class="text-lg font-bold">
                    AuctionPro
                </h1>

                <p class="text-xs text-slate-400">
                    Management System
                </p>

            </div>

        </div>


        <!-- Navigation -->

        <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                Main Menu
            </p>


            <!-- Dashboard -->

            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                <span>Dashboard</span>

            </a>


            <!-- Auctions -->

            <a href="{{ route('auctions.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="gavel" class="w-5 h-5"></i>

                <span>Auctions</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Auction::count() }}
                </span>

            </a>


            <!-- Lots -->

            <a href="{{ route('lots.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="package" class="w-5 h-5"></i>

                <span>Lots</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\Lot::count() }}
                </span>

            </a>


            <!-- Bulk Imports -->

            <a href="{{ route('bulk-imports.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="upload" class="w-5 h-5"></i>

                <span>Bulk Imports</span>

                <span class="ml-auto bg-indigo-500 text-xs px-2 py-1 rounded-full">
                    {{ \App\Models\BulkImport::count() }}
                </span>

            </a>


            <!-- Live Bidding -->

            <a href="{{ route('live-bidding.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="radio" class="w-5 h-5"></i>

                <span>Live Bidding</span>

                <span class="ml-auto flex items-center gap-1">

                    <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>

                    <span class="text-xs text-red-400">
                        LIVE
                    </span>

                </span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                Management
            </p>


            <!-- Bidders -->

            <a href="{{ route('bidders.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="users" class="w-5 h-5"></i>

                <span>Bidders</span>

            </a>


            <!-- Sellers -->

            <a href="{{ route('sellers.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="user-round" class="w-5 h-5"></i>

                <span>Sellers</span>

            </a>


            <!-- Payments -->

            <a href="{{ route('payments.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="credit-card" class="w-5 h-5"></i>

                <span>Payments</span>

            </a>


            <!-- Shipping -->

            <a href="{{ route('shipping-pickups.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="truck" class="w-5 h-5"></i>

                <span>Shipping & Pickup</span>

            </a>


            <!-- Reports -->

            <a href="{{ route('reports.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="file-chart-column" class="w-5 h-5"></i>

                <span>Reports</span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                System
            </p>


            <!-- Users -->

            <a href="{{ route('users.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg bg-indigo-600 text-white">

                <i data-lucide="shield-check" class="w-5 h-5"></i>

                <span>Users & Roles</span>

            </a>


            <!-- Notifications -->

            <a href="{{ route('notifications.index')}}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="bell" class="w-5 h-5"></i>

                <span>Notifications</span>

            </a>


            <!-- Settings -->

            <a href="{{ route('settings.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="settings" class="w-5 h-5"></i>

                <span>Settings</span>

            </a>


            <!-- Audit -->

            <a href="{{ route('audit-logs.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                <i data-lucide="file-clock" class="w-5 h-5"></i>

                <span>Audit Logs</span>

            </a>

        </nav>

    </aside>



    <!-- ========================= -->
    <!-- MAIN -->
    <!-- ========================= -->

    <div class="flex-1 lg:ml-64">


        <!-- TOP NAVBAR -->

        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-40">


            <div class="flex items-center gap-4">


                <button onclick="toggleSidebar()"
                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

                    <i data-lucide="menu" class="w-6 h-6"></i>

                </button>


                <!-- Search -->

                <form action="{{ route('users.index') }}" method="GET">

                    <div class="hidden sm:flex items-center bg-gray-100 rounded-xl px-4 py-2.5 w-64 lg:w-96">

                        <i data-lucide="search"
                            class="w-5 h-5 text-gray-400 mr-2">
                        </i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search users..."
                            class="bg-transparent outline-none w-full text-sm">

                    </div>

                </form>

            </div>


            <div class="flex items-center gap-3">


                <button class="relative p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="bell" class="w-5 h-5"></i>

                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>

                </button>


                <div class="flex items-center gap-3 border-l pl-4">

                    <div class="w-10 h-10 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">
                        AD
                    </div>

                    <div class="hidden md:block">

                        <p class="text-sm font-semibold">
                            Admin User
                        </p>

                        <p class="text-xs text-gray-500">
                            Super Administrator
                        </p>

                    </div>

                    <i data-lucide="chevron-down"
                        class="w-4 h-4 text-gray-500">
                    </i>

                </div>

            </div>

        </header>



        <!-- PAGE -->

        <main class="p-4 sm:p-6 lg:p-8">


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



            <!-- SUCCESS -->

            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3">

                    <i data-lucide="check-circle" class="w-5 h-5"></i>

                    {{ session('success') }}

                </div>

            @endif



            <!-- ERROR -->

            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3">

                    <i data-lucide="alert-circle" class="w-5 h-5"></i>

                    {{ session('error') }}

                </div>

            @endif



            <!-- STATISTICS -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">


                <!-- Total -->

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


                <!-- Admin -->

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


                <!-- Manager -->

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


                <!-- Staff -->

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


                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Search
                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Name or email..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">

                        </div>


                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Role
                            </label>

                            <select
                                name="role"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 outline-none focus:ring-2 focus:ring-indigo-500">

                                <option value="">
                                    All Roles
                                </option>

                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="Manager" {{ request('role') == 'Manager' ? 'selected' : '' }}>
                                    Manager
                                </option>

                                <option value="Staff" {{ request('role') == 'Staff' ? 'selected' : '' }}>
                                    Staff
                                </option>

                            </select>

                        </div>


                        <div class="flex items-end gap-2">

                            <button
                                type="submit"
                                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                                <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>

                                Filter

                            </button>


                            <a href="{{ route('users.index') }}"
                                class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>



            <!-- USERS TABLE -->

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">


                <div class="p-6 border-b border-gray-100">

                    <h3 class="text-lg font-bold">
                        System Users
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage users who have access to AuctionPro.
                    </p>

                </div>


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

                                            <a href="{{ route('users.show', $user) }}"
                                                title="View User"
                                                class="p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 transition">

                                                <i data-lucide="eye" class="w-5 h-5"></i>

                                            </a>


                                            <!-- EDIT -->

                                            <a href="{{ route('users.edit', $user) }}"
                                                title="Edit User"
                                                class="p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 transition">

                                                <i data-lucide="edit" class="w-5 h-5"></i>

                                            </a>


                                            <!-- DELETE -->

                                            <form
                                                action="{{ route('users.destroy', $user) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Delete User"
                                                    class="p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-red-50 transition">

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


        </main>

    </div>

</div>



<script>

    lucide.createIcons();


    function toggleSidebar()
    {
        const sidebar = document.getElementById('sidebar');

        sidebar.classList.toggle('-translate-x-full');
    }

</script>


</body>

</html>