<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Audit Logs - AuctionPro</title>

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


    <!-- SIDEBAR -->

    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 w-64
                  bg-slate-950 text-white
                  transform -translate-x-full
                  lg:translate-x-0
                  transition-transform duration-300">


        <!-- Logo -->

        <div class="h-20 flex items-center px-6
                    border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600
                        rounded-xl flex items-center
                        justify-center mr-3">

                <i data-lucide="gavel"
                   class="w-6 h-6"></i>

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

        <nav class="p-4 space-y-1
                    overflow-y-auto
                    h-[calc(100vh-80px)]">


            <p class="text-xs uppercase
                      text-slate-500
                      font-semibold px-3 mb-3">

                Main Menu

            </p>


            <!-- Dashboard -->

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="layout-dashboard"
                   class="w-5 h-5"></i>

                <span>Dashboard</span>

            </a>


            <!-- Auctions -->

            <a href="{{ route('auctions.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="gavel"
                   class="w-5 h-5"></i>

                <span>Auctions</span>

            </a>


            <!-- Lots -->

            <a href="{{ route('lots.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="package"
                   class="w-5 h-5"></i>

                <span>Lots</span>

            </a>


            <!-- Bulk Imports -->

            <a href="{{ route('bulk-imports.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="upload"
                   class="w-5 h-5"></i>

                <span>Bulk Imports</span>

            </a>


            <!-- Live Bidding -->

            <a href="{{ route('live-bidding.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="radio"
                   class="w-5 h-5"></i>

                <span>Live Bidding</span>

                <span class="ml-auto text-xs text-red-400">
                    LIVE
                </span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase
                      text-slate-500
                      font-semibold px-3 mb-3">

                Management

            </p>


            <!-- Bidders -->

            <a href="{{ route('bidders.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="users"
                   class="w-5 h-5"></i>

                <span>Bidders</span>

            </a>


            <!-- Sellers -->

            <a href="{{ route('sellers.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="user-round"
                   class="w-5 h-5"></i>

                <span>Sellers</span>

            </a>


            <!-- Payments -->

            <a href="{{ route('payments.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="credit-card"
                   class="w-5 h-5"></i>

                <span>Payments</span>

            </a>


            <!-- Shipping -->

            <a href="{{ route('shipping-pickups.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="truck"
                   class="w-5 h-5"></i>

                <span>Shipping & Pickup</span>

            </a>


            <!-- Reports -->

            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="bar-chart-3"
                   class="w-5 h-5"></i>

                <span>Reports</span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase
                      text-slate-500
                      font-semibold px-3 mb-3">

                System

            </p>


            <!-- Users -->

            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="shield-check"
                   class="w-5 h-5"></i>

                <span>Users & Roles</span>

            </a>


            <!-- Notifications -->

            <a href="{{ route('notifications.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="bell"
                   class="w-5 h-5"></i>

                <span>Notifications</span>

            </a>


            <!-- Settings -->

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800">

                <i data-lucide="settings"
                   class="w-5 h-5"></i>

                <span>Settings</span>

            </a>


            <!-- Audit Logs -->

            <a href="{{ route('audit-logs.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg
                      bg-indigo-600 text-white">

                <i data-lucide="file-clock"
                   class="w-5 h-5"></i>

                <span>Audit Logs</span>

            </a>


        </nav>

    </aside>



    <!-- MAIN -->

    <div class="flex-1 lg:ml-64">


        <!-- HEADER -->

        <header class="h-20 bg-white
                       border-b border-gray-200
                       flex items-center
                       justify-between
                       px-4 sm:px-6 lg:px-8
                       sticky top-0 z-40">


            <div class="flex items-center gap-4">


                <!-- Mobile Menu -->

                <button onclick="toggleSidebar()"
                        class="lg:hidden p-2
                               rounded-lg
                               hover:bg-gray-100">

                    <i data-lucide="menu"
                       class="w-6 h-6"></i>

                </button>


                <!-- Search -->

                <form method="GET"
                      action="{{ route('audit-logs.index') }}"
                      class="hidden sm:flex
                             items-center
                             bg-gray-100
                             rounded-xl
                             px-4 py-2.5
                             w-64 lg:w-96">

                    <i data-lucide="search"
                       class="w-5 h-5
                              text-gray-400 mr-2"></i>

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search audit logs..."
                           class="bg-transparent
                                  outline-none
                                  w-full text-sm">

                </form>

            </div>


            <!-- Profile -->

            <div class="flex items-center gap-3">


                <div class="flex items-center gap-3
                            border-l pl-4">

                    <div class="w-10 h-10
                                bg-indigo-600
                                text-white
                                rounded-full
                                flex items-center
                                justify-center
                                font-bold">

                        {{ strtoupper(
                            substr(auth()->user()->name, 0, 2)
                        ) }}

                    </div>


                    <div class="hidden md:block">

                        <p class="text-sm font-semibold">

                            {{ auth()->user()->name }}

                        </p>

                        <p class="text-xs text-gray-500">

                            {{ auth()->user()->role }}

                        </p>

                    </div>

                </div>

            </div>

        </header>



        <!-- CONTENT -->

        <main class="p-4 sm:p-6 lg:p-8">


            <!-- SUCCESS -->

            @if(session('success'))

                <div class="mb-6
                            bg-green-50
                            border border-green-200
                            text-green-700
                            px-4 py-3
                            rounded-xl
                            flex items-center gap-3">

                    <i data-lucide="check-circle"
                       class="w-5 h-5"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            <!-- HEADER -->

            <div class="flex flex-col
                        md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4 mb-8">


                <div>

                    <h2 class="text-2xl sm:text-3xl
                               font-bold text-gray-900">

                        Audit Logs

                    </h2>

                    <p class="text-gray-500 mt-1">

                        Track important activities
                        performed in AuctionPro.

                    </p>

                </div>


                @if($logs->count() > 0)

                    <form method="POST"
                          action="{{ route('audit-logs.destroy-all') }}"
                          onsubmit="return confirm('Delete ALL audit logs? This cannot be undone.');">

                        @csrf

                        @method('DELETE')

                        <button type="submit"
                                class="flex items-center
                                       gap-2 px-4 py-2.5
                                       bg-red-50
                                       text-red-600
                                       rounded-xl
                                       hover:bg-red-100">

                            <i data-lucide="trash-2"
                               class="w-4 h-4"></i>

                            Clear All Logs

                        </button>

                    </form>

                @endif

            </div>



            <!-- STATISTICS -->

            <div class="grid grid-cols-1
                        sm:grid-cols-3
                        gap-5 mb-8">


                <!-- Total -->

                <div class="bg-white
                            rounded-2xl
                            p-5
                            border border-gray-100
                            shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12
                                    bg-indigo-100
                                    text-indigo-600
                                    rounded-xl
                                    flex items-center
                                    justify-center">

                            <i data-lucide="activity"
                               class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Logs
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $totalLogs }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Today -->

                <div class="bg-white
                            rounded-2xl
                            p-5
                            border border-gray-100
                            shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12
                                    bg-blue-100
                                    text-blue-600
                                    rounded-xl
                                    flex items-center
                                    justify-center">

                            <i data-lucide="calendar-days"
                               class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Today's Activities
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $todayLogs }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- User Actions -->

                <div class="bg-white
                            rounded-2xl
                            p-5
                            border border-gray-100
                            shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12
                                    bg-green-100
                                    text-green-600
                                    rounded-xl
                                    flex items-center
                                    justify-center">

                            <i data-lucide="user-check"
                               class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                User Actions
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $userActions }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>



            <!-- FILTERS -->

            <div class="bg-white
                        rounded-2xl
                        border border-gray-100
                        shadow-sm
                        p-5 mb-6">


                <form method="GET"
                      action="{{ route('audit-logs.index') }}"
                      class="grid grid-cols-1
                             md:grid-cols-4
                             gap-4">


                    <!-- Search -->

                    <div>

                        <label class="block
                                      text-sm
                                      font-medium
                                      text-gray-700
                                      mb-2">

                            Search

                        </label>

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search..."
                               class="w-full
                                      border border-gray-200
                                      rounded-xl
                                      px-4 py-2.5
                                      focus:ring-2
                                      focus:ring-indigo-500
                                      outline-none">

                    </div>


                    <!-- Module -->

                    <div>

                        <label class="block
                                      text-sm
                                      font-medium
                                      text-gray-700
                                      mb-2">

                            Module

                        </label>

                        <select name="module"
                                class="w-full
                                       border border-gray-200
                                       rounded-xl
                                       px-4 py-2.5
                                       outline-none">

                            <option value="">
                                All Modules
                            </option>

                            @foreach($modules as $module)

                                <option value="{{ $module }}"
                                    {{ request('module') == $module ? 'selected' : '' }}>

                                    {{ ucfirst($module) }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Action -->

                    <div>

                        <label class="block
                                      text-sm
                                      font-medium
                                      text-gray-700
                                      mb-2">

                            Action

                        </label>

                        <select name="action"
                                class="w-full
                                       border border-gray-200
                                       rounded-xl
                                       px-4 py-2.5
                                       outline-none">

                            <option value="">
                                All Actions
                            </option>

                            @foreach($actions as $action)

                                <option value="{{ $action }}"
                                    {{ request('action') == $action ? 'selected' : '' }}>

                                    {{ ucfirst(str_replace('_', ' ', $action)) }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- Buttons -->

                    <div class="flex items-end gap-2">

                        <button type="submit"
                                class="flex-1
                                       bg-indigo-600
                                       text-white
                                       rounded-xl
                                       px-4 py-2.5
                                       hover:bg-indigo-700">

                            Filter

                        </button>


                        <a href="{{ route('audit-logs.index') }}"
                           class="px-4 py-2.5
                                  bg-gray-100
                                  rounded-xl
                                  hover:bg-gray-200">

                            Reset

                        </a>

                    </div>

                </form>

            </div>



            <!-- LOG TABLE -->

            <div class="bg-white
                        rounded-2xl
                        border border-gray-100
                        shadow-sm
                        overflow-hidden">


                <div class="p-6
                            border-b
                            border-gray-100">

                    <h3 class="text-lg font-bold">

                        Activity History

                    </h3>

                    <p class="text-sm
                              text-gray-500
                              mt-1">

                        All important system activities.

                    </p>

                </div>



                <div class="overflow-x-auto">


                    <table class="w-full">


                        <thead class="bg-gray-50">


                            <tr>

                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    User

                                </th>


                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    Action

                                </th>


                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    Module

                                </th>


                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    Description

                                </th>


                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    IP Address

                                </th>


                                <th class="text-left
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    Date

                                </th>


                                <th class="text-right
                                           px-6 py-4
                                           text-xs
                                           font-semibold
                                           text-gray-500
                                           uppercase">

                                    Action

                                </th>

                            </tr>


                        </thead>



                        <tbody class="divide-y
                                     divide-gray-100">


                            @forelse($logs as $log)


                                <tr class="hover:bg-gray-50">


                                    <!-- USER -->

                                    <td class="px-6 py-4">

                                        <div class="flex
                                                    items-center
                                                    gap-3">


                                            <div class="w-9 h-9
                                                        bg-indigo-100
                                                        text-indigo-600
                                                        rounded-full
                                                        flex items-center
                                                        justify-center
                                                        font-semibold">

                                                {{ strtoupper(
                                                    substr(
                                                        $log->user->name ?? 'SY',
                                                        0,
                                                        2
                                                    )
                                                ) }}

                                            </div>


                                            <div>

                                                <p class="font-medium
                                                          text-gray-900">

                                                    {{ $log->user->name ?? 'System' }}

                                                </p>

                                                @if($log->user)

                                                    <p class="text-xs
                                                              text-gray-500">

                                                        {{ $log->user->email }}

                                                    </p>

                                                @endif

                                            </div>

                                        </div>

                                    </td>



                                    <!-- ACTION -->

                                    <td class="px-6 py-4">

                                        <span class="inline-flex
                                                     items-center
                                                     px-2.5 py-1
                                                     rounded-full
                                                     text-xs
                                                     font-medium
                                                     bg-indigo-100
                                                     text-indigo-700">

                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $log->action
                                                )
                                            ) }}

                                        </span>

                                    </td>



                                    <!-- MODULE -->

                                    <td class="px-6 py-4">

                                        <span class="text-sm
                                                     font-medium
                                                     text-gray-700">

                                            {{ ucfirst(
                                                $log->module ?? 'System'
                                            ) }}

                                        </span>

                                    </td>



                                    <!-- DESCRIPTION -->

                                    <td class="px-6 py-4">

                                        <p class="text-sm
                                                  text-gray-700
                                                  max-w-md">

                                            {{ $log->description }}

                                        </p>

                                    </td>



                                    <!-- IP -->

                                    <td class="px-6 py-4">

                                        <span class="text-sm
                                                     text-gray-500">

                                            {{ $log->ip_address ?? '-' }}

                                        </span>

                                    </td>



                                    <!-- DATE -->

                                    <td class="px-6 py-4">

                                        <p class="text-sm
                                                  text-gray-700">

                                            {{ $log->created_at->format('d M Y') }}

                                        </p>

                                        <p class="text-xs
                                                  text-gray-400">

                                            {{ $log->created_at->format('h:i A') }}

                                        </p>

                                    </td>



                                    <!-- DELETE -->

                                    <td class="px-6 py-4
                                               text-right">


                                        <form method="POST"
                                              action="{{ route(
                                                  'audit-logs.destroy',
                                                  $log->id
                                              ) }}"
                                              onsubmit="return confirm('Delete this audit log?');">

                                            @csrf

                                            @method('DELETE')


                                            <button type="submit"
                                                    title="Delete"
                                                    class="p-2
                                                           rounded-lg
                                                           text-gray-500
                                                           hover:text-red-600
                                                           hover:bg-red-50">

                                                <i data-lucide="trash-2"
                                                   class="w-5 h-5"></i>

                                            </button>

                                        </form>


                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="7"
                                        class="py-16
                                               text-center">


                                        <div class="w-16 h-16
                                                    bg-gray-100
                                                    text-gray-400
                                                    rounded-full
                                                    flex items-center
                                                    justify-center
                                                    mx-auto">

                                            <i data-lucide="file-clock"
                                               class="w-8 h-8"></i>

                                        </div>


                                        <h3 class="text-lg
                                                   font-semibold
                                                   text-gray-900
                                                   mt-4">

                                            No Audit Logs

                                        </h3>


                                        <p class="text-sm
                                                  text-gray-500
                                                  mt-1">

                                            No system activity
                                            has been recorded yet.

                                        </p>


                                    </td>

                                </tr>


                            @endforelse


                        </tbody>

                    </table>

                </div>



                <!-- PAGINATION -->

                @if($logs->hasPages())

                    <div class="p-6
                                border-t
                                border-gray-100">

                        {{ $logs->links() }}

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
        const sidebar =
            document.getElementById('sidebar');

        sidebar.classList.toggle(
            '-translate-x-full'
        );
    }

</script>


</body>

</html>