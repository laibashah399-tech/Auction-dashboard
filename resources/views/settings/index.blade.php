<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Settings - AuctionPro</title>

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


    <!-- ================================================= -->
    <!-- SIDEBAR -->
    <!-- ================================================= -->

    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-950 text-white
                  transform -translate-x-full lg:translate-x-0
                  transition-transform duration-300">


        <!-- Logo -->

        <div class="h-20 flex items-center px-6 border-b border-slate-800">

            <div class="w-10 h-10 bg-indigo-600 rounded-xl
                        flex items-center justify-center mr-3">

                <i data-lucide="gavel"
                   class="w-6 h-6">
                </i>

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


            <p class="text-xs uppercase text-slate-500
                      font-semibold px-3 mb-3">

                Main Menu

            </p>


            <!-- Dashboard -->

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="layout-dashboard"
                   class="w-5 h-5">
                </i>

                <span>
                    Dashboard
                </span>

            </a>


            <!-- Auctions -->

            <a href="{{ route('auctions.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="gavel"
                   class="w-5 h-5">
                </i>

                <span>
                    Auctions
                </span>

            </a>


            <!-- Lots -->

            <a href="{{ route('lots.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="package"
                   class="w-5 h-5">
                </i>

                <span>
                    Lots
                </span>

            </a>


            <!-- Bulk Imports -->

            <a href="{{ route('bulk-imports.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="upload"
                   class="w-5 h-5">
                </i>

                <span>
                    Bulk Imports
                </span>

            </a>


            <!-- Live Bidding -->

            <a href="{{ route('live-bidding.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="radio"
                   class="w-5 h-5">
                </i>

                <span>
                    Live Bidding
                </span>

                <span class="ml-auto flex items-center gap-1">

                    <span class="w-2 h-2 bg-red-500
                                 rounded-full animate-pulse">
                    </span>

                    <span class="text-xs text-red-400">
                        LIVE
                    </span>

                </span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500
                      font-semibold px-3 mb-3">

                Management

            </p>


            <!-- Bidders -->

            <a href="{{ route('bidders.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="users"
                   class="w-5 h-5">
                </i>

                <span>
                    Bidders
                </span>

            </a>


            <!-- Sellers -->

            <a href="{{ route('sellers.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="user-round"
                   class="w-5 h-5">
                </i>

                <span>
                    Sellers
                </span>

            </a>


            <!-- Payments -->

            <a href="{{ route('payments.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="credit-card"
                   class="w-5 h-5">
                </i>

                <span>
                    Payments
                </span>

            </a>


            <!-- Shipping -->

            <a href="{{ route('shipping-pickups.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="truck"
                   class="w-5 h-5">
                </i>

                <span>
                    Shipping & Pickup
                </span>

            </a>


            <!-- Reports -->

            <a href="{{ route('reports.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="bar-chart-3"
                   class="w-5 h-5">
                </i>

                <span>
                    Reports
                </span>

            </a>


            <div class="border-t border-slate-800 my-4"></div>


            <p class="text-xs uppercase text-slate-500
                      font-semibold px-3 mb-3">

                System

            </p>


            <!-- Users -->

            <a href="{{ route('users.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="shield-check"
                   class="w-5 h-5">
                </i>

                <span>
                    Users & Roles
                </span>

            </a>


            <!-- Notifications -->

            <a href="{{ route('notifications.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="bell"
                   class="w-5 h-5">
                </i>

                <span>
                    Notifications
                </span>

            </a>


            <!-- Settings -->

            <a href="{{ route('settings.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg bg-indigo-600 text-white">

                <i data-lucide="settings"
                   class="w-5 h-5">
                </i>

                <span>
                    Settings
                </span>

            </a>


            <!-- Audit -->

            <a href="{{ route('audit-logs.index') }}"
               class="flex items-center gap-3 px-3 py-3
                      rounded-lg hover:bg-slate-800 transition">

                <i data-lucide="file-clock"
                   class="w-5 h-5">
                </i>

                <span>
                    Audit Logs
                </span>

            </a>

        </nav>

    </aside>



    <!-- ================================================= -->
    <!-- MAIN -->
    <!-- ================================================= -->

    <div class="flex-1 lg:ml-64">


        <!-- ================================================= -->
        <!-- TOP NAVBAR -->
        <!-- ================================================= -->

        <header class="h-20 bg-white border-b border-gray-200
                       flex items-center justify-between
                       px-4 sm:px-6 lg:px-8
                       sticky top-0 z-40">


            <div class="flex items-center gap-4">


                <!-- Mobile menu -->

                <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg
                               hover:bg-gray-100">

                    <i data-lucide="menu"
                       class="w-6 h-6">
                    </i>

                </button>


                <!-- Search -->

                <div class="hidden sm:flex items-center
                            bg-gray-100 rounded-xl
                            px-4 py-2.5
                            w-64 lg:w-96">

                    <i data-lucide="search"
                       class="w-5 h-5 text-gray-400 mr-2">
                    </i>

                    <input type="text"
                           placeholder="Search..."
                           class="bg-transparent outline-none
                                  w-full text-sm">

                </div>

            </div>


            <div class="flex items-center gap-3">


                <!-- Notification -->

                <a href="{{ route('notifications.index') }}"
                   class="relative p-2 hover:bg-gray-100 rounded-lg">

                    <i data-lucide="bell"
                       class="w-5 h-5">
                    </i>

                </a>


                <!-- Profile -->

                <div class="flex items-center gap-3 border-l pl-4">

                    <div class="w-10 h-10 bg-indigo-600
                                text-white rounded-full
                                flex items-center justify-center
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



        <!-- ================================================= -->
        <!-- PAGE CONTENT -->
        <!-- ================================================= -->

        <main class="p-4 sm:p-6 lg:p-8">


            <!-- Success -->

            @if(session('success'))

                <div class="mb-6 bg-green-50
                            border border-green-200
                            text-green-700
                            px-4 py-3 rounded-xl
                            flex items-center gap-3">

                    <i data-lucide="check-circle"
                       class="w-5 h-5">
                    </i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            <!-- Validation Errors -->

            @if($errors->any())

                <div class="mb-6 bg-red-50
                            border border-red-200
                            text-red-700
                            px-4 py-3 rounded-xl">

                    <div class="flex items-center gap-2 mb-2">

                        <i data-lucide="alert-circle"
                           class="w-5 h-5">
                        </i>

                        <strong>
                            Please fix the following errors:
                        </strong>

                    </div>

                    <ul class="list-disc ml-7 text-sm">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            <!-- Page Header -->

            <div class="mb-8">

                <h2 class="text-2xl sm:text-3xl
                           font-bold text-gray-900">

                    Settings

                </h2>

                <p class="text-gray-500 mt-1">

                    Manage AuctionPro system settings
                    and preferences.

                </p>

            </div>



            <!-- ================================================= -->
            <!-- SETTINGS FORM -->
            <!-- ================================================= -->

            <form method="POST"
                  action="{{ route('settings.update') }}">

                @csrf

                @method('PUT')


                <!-- ================================================= -->
                <!-- GENERAL SETTINGS -->
                <!-- ================================================= -->

                <div class="bg-white rounded-2xl
                            border border-gray-100
                            shadow-sm mb-6">


                    <div class="p-6 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10
                                        bg-indigo-100
                                        text-indigo-600
                                        rounded-xl
                                        flex items-center
                                        justify-center">

                                <i data-lucide="settings"
                                   class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold">
                                    General Settings
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Basic information about your
                                    AuctionPro system.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <div class="grid grid-cols-1
                                    md:grid-cols-2
                                    gap-6">


                            <!-- Site Name -->

                            <div>

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Site Name

                                </label>

                                <input type="text"
                                       name="site_name"
                                       value="{{ old('site_name', $settings['site_name'] ?? 'AuctionPro') }}"
                                       required
                                       class="w-full px-4 py-3
                                              border border-gray-300
                                              rounded-xl
                                              focus:ring-2
                                              focus:ring-indigo-500
                                              focus:border-indigo-500
                                              outline-none">

                            </div>


                            <!-- Admin Email -->

                            <div>

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Admin Email

                                </label>

                                <input type="email"
                                       name="admin_email"
                                       value="{{ old('admin_email', $settings['admin_email'] ?? '') }}"
                                       required
                                       class="w-full px-4 py-3
                                              border border-gray-300
                                              rounded-xl
                                              focus:ring-2
                                              focus:ring-indigo-500
                                              focus:border-indigo-500
                                              outline-none">

                            </div>


                            <!-- Phone -->

                            <div>

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Phone Number

                                </label>

                                <input type="text"
                                       name="phone"
                                       value="{{ old('phone', $settings['phone'] ?? '') }}"
                                       placeholder="+92 300 0000000"
                                       class="w-full px-4 py-3
                                              border border-gray-300
                                              rounded-xl
                                              focus:ring-2
                                              focus:ring-indigo-500
                                              focus:border-indigo-500
                                              outline-none">

                            </div>


                            <!-- Currency -->

                            <div>

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Currency

                                </label>

                                <select name="currency"
                                        class="w-full px-4 py-3
                                               border border-gray-300
                                               rounded-xl
                                               focus:ring-2
                                               focus:ring-indigo-500
                                               outline-none">

                                    <option value="PKR"
                                        {{ ($settings['currency'] ?? 'PKR') === 'PKR' ? 'selected' : '' }}>
                                        PKR - Pakistani Rupee
                                    </option>

                                    <option value="USD"
                                        {{ ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' }}>
                                        USD - US Dollar
                                    </option>

                                    <option value="EUR"
                                        {{ ($settings['currency'] ?? '') === 'EUR' ? 'selected' : '' }}>
                                        EUR - Euro
                                    </option>

                                    <option value="GBP"
                                        {{ ($settings['currency'] ?? '') === 'GBP' ? 'selected' : '' }}>
                                        GBP - British Pound
                                    </option>

                                </select>

                            </div>


                            <!-- Timezone -->

                            <div>

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Timezone

                                </label>

                                <select name="timezone"
                                        class="w-full px-4 py-3
                                               border border-gray-300
                                               rounded-xl
                                               focus:ring-2
                                               focus:ring-indigo-500
                                               outline-none">

                                    <option value="Asia/Karachi"
                                        {{ ($settings['timezone'] ?? 'Asia/Karachi') === 'Asia/Karachi' ? 'selected' : '' }}>
                                        Asia/Karachi
                                    </option>

                                    <option value="UTC"
                                        {{ ($settings['timezone'] ?? '') === 'UTC' ? 'selected' : '' }}>
                                        UTC
                                    </option>

                                    <option value="Asia/Dubai"
                                        {{ ($settings['timezone'] ?? '') === 'Asia/Dubai' ? 'selected' : '' }}>
                                        Asia/Dubai
                                    </option>

                                    <option value="Europe/London"
                                        {{ ($settings['timezone'] ?? '') === 'Europe/London' ? 'selected' : '' }}>
                                        Europe/London
                                    </option>

                                    <option value="America/New_York"
                                        {{ ($settings['timezone'] ?? '') === 'America/New_York' ? 'selected' : '' }}>
                                        America/New_York
                                    </option>

                                </select>

                            </div>


                            <!-- Description -->

                            <div class="md:col-span-2">

                                <label class="block text-sm
                                              font-medium
                                              text-gray-700 mb-2">

                                    Site Description

                                </label>

                                <textarea name="site_description"
                                          rows="4"
                                          placeholder="Enter a short description..."
                                          class="w-full px-4 py-3
                                                 border border-gray-300
                                                 rounded-xl
                                                 focus:ring-2
                                                 focus:ring-indigo-500
                                                 focus:border-indigo-500
                                                 outline-none">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- ================================================= -->
                <!-- NOTIFICATION SETTINGS -->
                <!-- ================================================= -->

                <div class="bg-white rounded-2xl
                            border border-gray-100
                            shadow-sm mb-6">


                    <div class="p-6 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10
                                        bg-blue-100
                                        text-blue-600
                                        rounded-xl
                                        flex items-center
                                        justify-center">

                                <i data-lucide="bell"
                                   class="w-5 h-5">
                                </i>

                            </div>

                            <div>

                                <h3 class="text-lg font-bold">

                                    Notification Settings

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Control how AuctionPro
                                    notifications work.

                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="divide-y divide-gray-100">


                        <!-- Email Notifications -->

                        <div class="p-6 flex items-center
                                    justify-between gap-4">

                            <div>

                                <h4 class="font-semibold
                                           text-gray-900">

                                    Email Notifications

                                </h4>

                                <p class="text-sm text-gray-500 mt-1">

                                    Allow the system to send
                                    notification emails.

                                </p>

                            </div>


                            <label class="relative
                                          inline-flex
                                          items-center
                                          cursor-pointer">

                                <input type="checkbox"
                                       name="email_notifications"
                                       value="1"
                                       class="sr-only peer"
                                       {{ ($settings['email_notifications'] ?? '1') == '1' ? 'checked' : '' }}>

                                <div class="w-11 h-6
                                            bg-gray-200
                                            rounded-full
                                            peer
                                            peer-checked:bg-indigo-600
                                            after:content-['']
                                            after:absolute
                                            after:top-[2px]
                                            after:left-[2px]
                                            after:bg-white
                                            after:rounded-full
                                            after:h-5
                                            after:w-5
                                            after:transition-all
                                            peer-checked:after:translate-x-full">
                                </div>

                            </label>

                        </div>



                        <!-- System Notifications -->

                        <div class="p-6 flex items-center
                                    justify-between gap-4">

                            <div>

                                <h4 class="font-semibold
                                           text-gray-900">

                                    System Notifications

                                </h4>

                                <p class="text-sm text-gray-500 mt-1">

                                    Show automatic activity
                                    notifications in AuctionPro.

                                </p>

                            </div>


                            <label class="relative
                                          inline-flex
                                          items-center
                                          cursor-pointer">

                                <input type="checkbox"
                                       name="system_notifications"
                                       value="1"
                                       class="sr-only peer"
                                       {{ ($settings['system_notifications'] ?? '1') == '1' ? 'checked' : '' }}>

                                <div class="w-11 h-6
                                            bg-gray-200
                                            rounded-full
                                            peer
                                            peer-checked:bg-indigo-600
                                            after:content-['']
                                            after:absolute
                                            after:top-[2px]
                                            after:left-[2px]
                                            after:bg-white
                                            after:rounded-full
                                            after:h-5
                                            after:w-5
                                            after:transition-all
                                            peer-checked:after:translate-x-full">
                                </div>

                            </label>

                        </div>



                        <!-- Auction Auto Approval -->

                        <div class="p-6 flex items-center
                                    justify-between gap-4">

                            <div>

                                <h4 class="font-semibold
                                           text-gray-900">

                                    Auction Auto Approval

                                </h4>

                                <p class="text-sm text-gray-500 mt-1">

                                    Automatically approve new
                                    auctions when they are created.

                                </p>

                            </div>


                            <label class="relative
                                          inline-flex
                                          items-center
                                          cursor-pointer">

                                <input type="checkbox"
                                       name="auction_auto_approval"
                                       value="1"
                                       class="sr-only peer"
                                       {{ ($settings['auction_auto_approval'] ?? '0') == '1' ? 'checked' : '' }}>

                                <div class="w-11 h-6
                                            bg-gray-200
                                            rounded-full
                                            peer
                                            peer-checked:bg-indigo-600
                                            after:content-['']
                                            after:absolute
                                            after:top-[2px]
                                            after:left-[2px]
                                            after:bg-white
                                            after:rounded-full
                                            after:h-5
                                            after:w-5
                                            after:transition-all
                                            peer-checked:after:translate-x-full">
                                </div>

                            </label>

                        </div>

                    </div>

                </div>



                <!-- ================================================= -->
                <!-- SAVE BUTTON -->
                <!-- ================================================= -->

                <div class="flex justify-end">

                    <button type="submit"
                            class="flex items-center gap-2
                                   px-6 py-3
                                   bg-indigo-600
                                   text-white
                                   rounded-xl
                                   font-semibold
                                   hover:bg-indigo-700
                                   transition
                                   shadow-sm">

                        <i data-lucide="save"
                           class="w-5 h-5">
                        </i>

                        Save Settings

                    </button>

                </div>


            </form>

        </main>

    </div>

</div>



<script>

    lucide.createIcons();


    function toggleSidebar()
    {
        const sidebar =
            document.getElementById('sidebar');

        sidebar.classList.toggle('-translate-x-full');
    }

</script>


</body>

</html>