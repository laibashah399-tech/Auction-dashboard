<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications - AuctionPro</title>

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
           class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white
                  transform -translate-x-full lg:translate-x-0
                  transition-transform duration-300">

        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl
                        flex items-center justify-center mr-3">

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

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                <span>Dashboard</span>

            </a>


            <a href="{{ route('auctions.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="gavel" class="w-5 h-5"></i>

                <span>Auctions</span>

            </a>


            <a href="{{ route('lots.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="package" class="w-5 h-5"></i>

                <span>Lots</span>

            </a>


            <a href="{{ route('bulk-imports.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="upload" class="w-5 h-5"></i>

                <span>Bulk Imports</span>

            </a>


            <a href="{{ route('live-bidding.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

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


            <a href="{{ route('bidders.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="users" class="w-5 h-5"></i>

                <span>Bidders</span>

            </a>


            <a href="{{ route('sellers.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="user-round" class="w-5 h-5"></i>

                <span>Sellers</span>

            </a>


            <a href="{{ route('payments.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="credit-card" class="w-5 h-5"></i>

                <span>Payments</span>

            </a>


            <a href="{{ route('shipping-pickups.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="truck" class="w-5 h-5"></i>

                <span>Shipping & Pickup</span>

            </a>


            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>

                <span>Reports</span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500 font-semibold px-3 mb-3">
                System
            </p>


            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="shield-check" class="w-5 h-5"></i>

                <span>Users & Roles</span>

            </a>


            <!-- Notifications -->
            <a href="{{ route('notifications.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg bg-indigo-600 text-white">

                <i data-lucide="bell" class="w-5 h-5"></i>

                <span>Notifications</span>

                @if($unreadCount > 0)

                    <span class="ml-auto bg-red-500 text-xs px-2 py-1 rounded-full">
                        {{ $unreadCount }}
                    </span>

                @endif

            </a>


            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="settings" class="w-5 h-5"></i>

                <span>Settings</span>

            </a>


            <a href="{{ route('audit-logs.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="file-clock" class="w-5 h-5"></i>

                <span>Audit Logs</span>

            </a>

        </nav>

    </aside>


    <!-- MAIN -->
    <div class="flex-1 lg:ml-64">

        <!-- TOP NAVBAR -->
        <header class="h-20 bg-white border-b border-gray-200
                       flex items-center justify-between
                       px-4 sm:px-6 lg:px-8
                       sticky top-0 z-40">

            <div class="flex items-center gap-4">

                <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg hover:bg-gray-100">

                    <i data-lucide="menu" class="w-6 h-6"></i>

                </button>


                <div class="hidden sm:flex items-center bg-gray-100 rounded-xl
                            px-4 py-2.5 w-64 lg:w-96">

                    <i data-lucide="search"
                       class="w-5 h-5 text-gray-400 mr-2"></i>

                    <input type="text"
                           placeholder="Search notifications..."
                           class="bg-transparent outline-none w-full text-sm">

                </div>

            </div>


            <div class="flex items-center gap-3">

                <!-- Notification Bell -->
                <a href="{{ route('notifications.index') }}"
                   class="relative p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="bell" class="w-5 h-5"></i>

                    @if($unreadCount > 0)

                        <span class="absolute -top-1 -right-1
                                     min-w-5 h-5 px-1
                                     bg-red-500 text-white
                                     text-xs rounded-full
                                     flex items-center justify-center">

                            {{ $unreadCount }}

                        </span>

                    @endif

                </a>


                <!-- Profile -->
                <div class="flex items-center gap-3 border-l pl-4">

                    <div class="w-10 h-10 bg-indigo-600 text-white
                                rounded-full flex items-center justify-center
                                font-bold">

                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}

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


        <!-- PAGE CONTENT -->
        <main class="p-4 sm:p-6 lg:p-8">

            <!-- Success Message -->
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl
                            flex items-center gap-3">

                    <i data-lucide="check-circle" class="w-5 h-5"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            <!-- Header -->
            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between
                        gap-4 mb-8">

                <div>

                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                        Notifications
                    </h2>

                    <p class="text-gray-500 mt-1">
                        Manage your system notifications and alerts.
                    </p>

                </div>


                <div class="flex gap-3">

                    @if($unreadCount > 0)

                        <form method="POST"
                              action="{{ route('notifications.read-all') }}">

                            @csrf

                            <button type="submit"
                                    class="flex items-center gap-2
                                           px-4 py-2.5 bg-indigo-600
                                           text-white rounded-xl
                                           hover:bg-indigo-700">

                                <i data-lucide="check-check" class="w-4 h-4"></i>

                                Mark All Read

                            </button>

                        </form>

                    @endif


                    @if($notifications->total() > 0)

                        <form method="POST"
                              action="{{ route('notifications.destroy-all') }}"
                              onsubmit="return confirm('Delete all notifications?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="flex items-center gap-2
                                           px-4 py-2.5 bg-red-50
                                           text-red-600 rounded-xl
                                           hover:bg-red-100">

                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                                Clear All

                            </button>

                        </form>

                    @endif

                </div>

            </div>


            <!-- SUMMARY CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">

                <!-- Total -->
                <div class="bg-white rounded-2xl p-5 border
                            border-gray-100 shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-indigo-100
                                    text-indigo-600 rounded-xl
                                    flex items-center justify-center">

                            <i data-lucide="bell" class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Total Notifications
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $notifications->total() }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Unread -->
                <div class="bg-white rounded-2xl p-5 border
                            border-gray-100 shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-red-100
                                    text-red-600 rounded-xl
                                    flex items-center justify-center">

                            <i data-lucide="mail" class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Unread
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $unreadCount }}
                            </h3>

                        </div>

                    </div>

                </div>


                <!-- Read -->
                <div class="bg-white rounded-2xl p-5 border
                            border-gray-100 shadow-sm">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12 bg-green-100
                                    text-green-600 rounded-xl
                                    flex items-center justify-center">

                            <i data-lucide="mail-check" class="w-6 h-6"></i>

                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Read
                            </p>

                            <h3 class="text-3xl font-bold">
                                {{ $notifications->total() - $unreadCount }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>


            <!-- NOTIFICATIONS LIST -->
            <div class="bg-white rounded-2xl border
                        border-gray-100 shadow-sm">

                <div class="p-6 border-b border-gray-100">

                    <h3 class="text-lg font-bold">
                        All Notifications
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Recent system alerts and activities.
                    </p>

                </div>


                <div class="divide-y divide-gray-100">

                    @forelse($notifications as $notification)

                        @php

                            $data = is_array($notification->data)
                                ? $notification->data
                                : json_decode($notification->data, true);

                            $data = is_array($data) ? $data : [];

                            $title = $data['title']
                                ?? 'System Notification';

                            $message = $data['message']
                                ?? 'You have a new notification.';

                            $type = $data['type']
                                ?? 'info';

                            /*
                             * IMPORTANT:
                             * $icon is defined HERE for EVERY notification.
                             */
                            $icon = match($type) {

                                'success' => 'check-circle',

                                'warning' => 'alert-triangle',

                                'error' => 'x-circle',

                                'auction' => 'gavel',

                                'bid' => 'trending-up',

                                'payment' => 'credit-card',

                                'user' => 'user-plus',

                                default => 'bell',

                            };

                        @endphp


                        <div class="p-6
                            {{ is_null($notification->read_at)
                                ? 'bg-indigo-50/40'
                                : 'bg-white' }}">

                            <div class="flex items-start gap-4">


                                <!-- ICON -->
                                <div class="w-12 h-12 shrink-0
                                            rounded-xl flex items-center
                                            justify-center

                                    @if($type === 'success')
                                        bg-green-100 text-green-600

                                    @elseif($type === 'warning')
                                        bg-yellow-100 text-yellow-600

                                    @elseif($type === 'error')
                                        bg-red-100 text-red-600

                                    @elseif($type === 'auction')
                                        bg-indigo-100 text-indigo-600

                                    @elseif($type === 'bid')
                                        bg-purple-100 text-purple-600

                                    @elseif($type === 'payment')
                                        bg-blue-100 text-blue-600

                                    @elseif($type === 'user')
                                        bg-green-100 text-green-600

                                    @else
                                        bg-gray-100 text-gray-600
                                    @endif
                                ">

                                    <i data-lucide="{{ $icon }}"
                                       class="w-6 h-6"></i>

                                </div>


                                <!-- CONTENT -->
                                <div class="flex-1 min-w-0">

                                    <div class="flex items-start
                                                justify-between gap-4">

                                        <div>

                                            <div class="flex items-center gap-2">

                                                <h4 class="font-semibold text-gray-900">

                                                    {{ $title }}

                                                </h4>


                                                @if(is_null($notification->read_at))

                                                    <span class="px-2 py-1 text-xs
                                                                 bg-indigo-100
                                                                 text-indigo-600
                                                                 rounded-full">

                                                        New

                                                    </span>

                                                @endif

                                            </div>


                                            <p class="text-sm text-gray-600 mt-1">

                                                {{ $message }}

                                            </p>


                                            <p class="text-xs text-gray-400 mt-2">

                                                {{ $notification->created_at->diffForHumans() }}

                                            </p>

                                        </div>


                                        <!-- ACTIONS -->
                                        <div class="flex items-center gap-2">

                                            @if(is_null($notification->read_at))

                                                <form method="POST"
                                                      action="{{ route('notifications.read', $notification->id) }}">

                                                    @csrf

                                                    <button type="submit"
                                                            title="Mark as read"
                                                            class="p-2 rounded-lg
                                                                   text-gray-500
                                                                   hover:text-green-600
                                                                   hover:bg-green-50">

                                                        <i data-lucide="check"
                                                           class="w-5 h-5"></i>

                                                    </button>

                                                </form>

                                            @endif


                                            <form method="POST"
                                                  action="{{ route('notifications.destroy', $notification->id) }}"
                                                  onsubmit="return confirm('Delete this notification?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        title="Delete"
                                                        class="p-2 rounded-lg
                                                               text-gray-500
                                                               hover:text-red-600
                                                               hover:bg-red-50">

                                                    <i data-lucide="trash-2"
                                                       class="w-5 h-5"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                    @empty

                        <div class="py-16 text-center">

                            <div class="w-16 h-16 bg-gray-100
                                        text-gray-400 rounded-full
                                        flex items-center justify-center
                                        mx-auto">

                                <i data-lucide="bell-off" class="w-8 h-8"></i>

                            </div>


                            <h3 class="text-lg font-semibold
                                       text-gray-900 mt-4">

                                No Notifications

                            </h3>


                            <p class="text-sm text-gray-500 mt-1">

                                You're all caught up!

                            </p>

                        </div>

                    @endforelse

                </div>


                <!-- Pagination -->
                @if($notifications->hasPages())

                    <div class="p-6 border-t border-gray-100">

                        {{ $notifications->links() }}

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