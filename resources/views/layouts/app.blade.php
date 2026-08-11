<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'AuctionPro')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
</head>


<body class="bg-slate-100 text-slate-800">


<div class="flex min-h-screen">


    {{-- SIDEBAR --}}
    <aside class="w-64 bg-slate-900 text-white fixed left-0 top-0 bottom-0 hidden md:flex flex-col z-50">


        {{-- LOGO --}}
        <div class="px-6 py-6 border-b border-slate-700">

            <h1 class="text-2xl font-bold text-white">
                AuctionPro
            </h1>

            <p class="text-sm text-slate-400 mt-1">
                Management System
            </p>

        </div>


        {{-- NAVIGATION --}}
        <nav class="flex-1 px-4 py-6 space-y-2">


            <p class="text-xs uppercase tracking-wider text-slate-500 px-3 mb-3">
                Main Menu
            </p>


            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg
               {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}
               transition">

                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- Auctions --}}
            <a href="{{ route('auctions.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg
               {{ request()->routeIs('auctions.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}
               transition">

                <i data-lucide="gavel" class="w-5 h-5"></i>

                <span>
                    Auctions
                </span>

            </a>


            {{-- Lots --}}
            <a href="{{ route('lots.index') }}"
               class="flex items-center gap-3 px-3 py-3 rounded-lg
               {{ request()->routeIs('lots.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}
               transition">

                <i data-lucide="package" class="w-5 h-5"></i>

                <span>
                    Lots
                </span>

            </a>


           {{--bulk-imports--}}

           <a href="{{ route('bulk-imports.index') }}"
   class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800 transition">

    <i data-lucide="upload-cloud" class="w-5 h-5"></i>

    <span>Bulk Imports</span>

</a>


            {{-- Bidders --}}
          <a href="{{ route('bidders.index') }}"
   class="flex items-center gap-3 px-3 py-3 rounded-lg
   {{ request()->routeIs('bidders.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}
   transition">

    <i data-lucide="users" class="w-5 h-5"></i>

    <span>
        Bidders
    </span>

</a>


            {{-- Payments --}}
           <a href="{{ route('payments.index') }}"
   class="flex items-center gap-3 px-3 py-3 rounded-lg
   {{ request()->routeIs('payments.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}
   transition">

    <i data-lucide="credit-card" class="w-5 h-5"></i>

    <span>
        Payments
    </span>

</a>


            <div class="pt-6">

                <p class="text-xs uppercase tracking-wider text-slate-500 px-3 mb-3">
                    Management
                </p>


                {{-- Reports --}}
                <a href="#"
                   class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <i data-lucide="bar-chart-3" class="w-5 h-5"></i>

                    <span>
                        Reports
                    </span>

                </a>


                {{-- Settings --}}
                <a href="#"
                   class="flex items-center gap-3 px-3 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition">

                    <i data-lucide="settings" class="w-5 h-5"></i>

                    <span>
                        Settings
                    </span>

                </a>

            </div>


        </nav>


        {{-- USER --}}
        <div class="p-4 border-t border-slate-700">


            <div class="flex items-center gap-3">


                <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center font-bold">

                    AD

                </div>


                <div>

                    <p class="text-sm font-semibold">
                        Admin User
                    </p>

                    <p class="text-xs text-slate-400">
                        Super Administrator
                    </p>

                </div>


            </div>


        </div>


    </aside>


    {{-- MAIN AREA --}}
    <main class="md:ml-64 flex-1 min-h-screen">


        {{-- TOP BAR --}}
        <header class="bg-white border-b border-slate-200 px-6 py-4">


            <div class="flex items-center justify-between">


                <div>

                    <h2 class="text-xl font-semibold text-slate-800">

                        @yield('page-heading', 'AuctionPro')

                    </h2>

                    <p class="text-sm text-slate-500">

                        @yield('page-description', 'Management System')

                    </p>

                </div>


                <div class="flex items-center gap-3">


                    <div class="hidden sm:block">

                        <input
                            type="text"
                            placeholder="Search..."
                            class="w-56 px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >

                    </div>


                    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center font-bold">

                        AD

                    </div>


                </div>


            </div>


        </header>


        {{-- PAGE CONTENT --}}
        <div class="p-6 md:p-8">

            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">

                    {{ session('error') }}

                </div>

            @endif


            @yield('content')


        </div>


    </main>


</div>


<script>

    lucide.createIcons();

</script>


</body>

</html>
