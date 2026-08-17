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

    <style>
        /* Sidebar scrollbar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }

        .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #334155 transparent;
        }
    </style>
</head>


<body class="bg-slate-100 text-slate-800">


<div class="flex min-h-screen">


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside
        id="sidebar"
        class="fixed left-0 top-0 bottom-0
               w-64
               bg-slate-900
               text-white
               z-50
               hidden md:flex
               flex-col
               h-screen"
    >


        {{-- =====================================================
             LOGO
        ====================================================== --}}

        <div class="px-6 py-6 border-b border-slate-700 shrink-0">

            <a href="{{ route('dashboard') }}" class="block">

                <h1 class="text-2xl font-bold text-white">
                    AuctionPro
                </h1>

                <p class="text-sm text-slate-400 mt-1">
                    Management System
                </p>

            </a>

        </div>


        {{-- =====================================================
             NAVIGATION
        ====================================================== --}}

        <nav
            class="sidebar-scroll
                   flex-1
                   min-h-0
                   overflow-y-auto
                   px-4
                   py-5
                   space-y-1"
        >


            {{-- ================= MAIN MENU ================= --}}

            <p class="text-xs uppercase tracking-wider text-slate-500 px-3 mb-3">
                Main Menu
            </p>


            {{-- Dashboard --}}

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}"
            >

                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- Auctions --}}

            <a
                href="{{ route('auctions.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                {{ request()->routeIs('auctions.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}"
            >

                <i data-lucide="gavel" class="w-5 h-5 shrink-0"></i>

                <span>
                    Auctions
                </span>

            </a>


            {{-- Lots --}}

            <a
                href="{{ route('lots.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                {{ request()->routeIs('lots.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}"
            >

                <i data-lucide="package" class="w-5 h-5 shrink-0"></i>

                <span>
                    Lots
                </span>

            </a>


            {{-- Bulk Imports --}}

            @if(Route::has('bulk-imports.index'))

                <a
                    href="{{ route('bulk-imports.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                    {{ request()->routeIs('bulk-imports.*')
                        ? 'bg-indigo-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}"
                >

                    <i data-lucide="upload-cloud" class="w-5 h-5 shrink-0"></i>

                    <span>
                        Bulk Imports
                    </span>

                </a>

            @endif


            {{-- Media Library --}}

            @if(Route::has('media.index'))

                <a
                    href="{{ route('media.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                    {{ request()->routeIs('media.*')
                        ? 'bg-indigo-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}"
                >

                    <i data-lucide="images" class="w-5 h-5 shrink-0"></i>

                    <span>
                        Media Library
                    </span>

                </a>

            @endif


            {{-- Live Bidding --}}

            @if(Route::has('live-bidding.index'))

                <a
                    href="{{ route('live-bidding.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                    {{ request()->routeIs('live-bidding.*')
                        ? 'bg-indigo-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}"
                >

                    <i data-lucide="radio" class="w-5 h-5 shrink-0"></i>

                    <span>
                        Live Bidding
                    </span>

                    <span
                        class="ml-auto
                               text-[10px]
                               font-semibold
                               bg-red-500
                               text-white
                               px-2
                               py-1
                               rounded-full"
                    >
                        LIVE
                    </span>

                </a>

            @endif


            {{-- Bidders --}}

            <a
                href="{{ route('bidders.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                {{ request()->routeIs('bidders.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}"
            >

                <i data-lucide="users" class="w-5 h-5 shrink-0"></i>

                <span>
                    Bidders
                </span>

            </a>


            {{-- Sellers --}}

            @if(Route::has('sellers.index'))

                <a
                    href="{{ route('sellers.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                    {{ request()->routeIs('sellers.*')
                        ? 'bg-indigo-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}"
                >

                    <i data-lucide="store" class="w-5 h-5 shrink-0"></i>

                    <span>
                        Sellers
                    </span>

                </a>

            @endif


            {{-- Payments --}}

            <a
                href="{{ route('payments.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                {{ request()->routeIs('payments.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800' }}"
            >

                <i data-lucide="credit-card" class="w-5 h-5 shrink-0"></i>

                <span>
                    Payments
                </span>

            </a>


            {{-- Shipping & Pickup --}}

            @if(Route::has('shipping.index'))

                <a
                    href="{{ route('shipping.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                    {{ request()->routeIs('shipping.*')
                        ? 'bg-indigo-600 text-white'
                        : 'text-slate-300 hover:bg-slate-800' }}"
                >

                    <i data-lucide="truck" class="w-5 h-5 shrink-0"></i>

                    <span>
                        Shipping & Pickup
                    </span>

                </a>

            @endif



            {{-- ================= MANAGEMENT ================= --}}

            <div class="pt-6">

                <p class="text-xs uppercase tracking-wider text-slate-500 px-3 mb-3">
                    Management
                </p>


                {{-- Reports --}}

                @if(Route::has('reports.index'))

                    <a
                        href="{{ route('reports.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                        {{ request()->routeIs('reports.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800' }}"
                    >

                        <i data-lucide="bar-chart-3" class="w-5 h-5 shrink-0"></i>

                        <span>
                            Reports
                        </span>

                    </a>

                @endif

            </div>



            {{-- ================= SYSTEM ================= --}}

            <div class="pt-6 pb-5">

                <p class="text-xs uppercase tracking-wider text-slate-500 px-3 mb-3">
                    System
                </p>


                {{-- Users & Roles --}}

                @if(Route::has('users.index'))

                    <a
                        href="{{ route('users.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                        {{ request()->routeIs('users.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800' }}"
                    >

                        <i data-lucide="shield-check" class="w-5 h-5 shrink-0"></i>

                        <span>
                            Users & Roles
                        </span>

                    </a>

                @endif


                {{-- Notifications --}}

                @if(Route::has('notifications.index'))

                    <a
                        href="{{ route('notifications.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                        {{ request()->routeIs('notifications.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800' }}"
                    >

                        <i data-lucide="bell" class="w-5 h-5 shrink-0"></i>

                        <span>
                            Notifications
                        </span>

                    </a>

                @endif


                {{-- Settings --}}

                @if(Route::has('settings.index'))

                    <a
                        href="{{ route('settings.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                        {{ request()->routeIs('settings.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800' }}"
                    >

                        <i data-lucide="settings" class="w-5 h-5 shrink-0"></i>

                        <span>
                            Settings
                        </span>

                    </a>

                @endif


                {{-- Audit Logs --}}

                @if(Route::has('audit-logs.index'))

                    <a
                        href="{{ route('audit-logs.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-lg transition
                        {{ request()->routeIs('audit-logs.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800' }}"
                    >

                        <i data-lucide="clipboard-list" class="w-5 h-5 shrink-0"></i>

                        <span>
                            Audit Logs
                        </span>

                    </a>

                @endif

            </div>

        </nav>



        {{-- =====================================================
             ADMIN / LOGOUT BOTTOM BAR
             Complete navigation-style bottom section
        ====================================================== --}}

        <div
            class="shrink-0
                   border-t
                   border-slate-700
                   bg-slate-900
                   px-4
                   py-4"
        >


            {{-- Admin Profile --}}

            <div
                class="flex items-center gap-3
                       px-3 py-3
                       rounded-xl
                       bg-slate-800/70
                       border border-slate-700"
            >

                {{-- Avatar --}}

                <div
                    class="w-10 h-10
                           bg-indigo-600
                           rounded-full
                           flex items-center
                           justify-center
                           font-bold
                           text-white
                           shrink-0"
                >

                    @auth

                        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}

                    @else

                        AD

                    @endauth

                </div>


                {{-- Admin Information --}}

                <div class="min-w-0 flex-1">

                    <p class="text-sm font-semibold text-white truncate">

                        @auth
                            {{ auth()->user()->name }}
                        @else
                            Admin User
                        @endauth

                    </p>

                    <p class="text-xs text-slate-400 truncate">
                        Super Administrator
                    </p>

                </div>


                {{-- Online Status --}}

                <span
                    class="w-2.5 h-2.5
                           bg-green-500
                           rounded-full
                           shrink-0"
                    title="Online"
                ></span>

            </div>



            {{-- Logout Navigation Item --}}

            @if(Route::has('logout'))

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-2"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full
                               flex items-center gap-3
                               px-3 py-3
                               rounded-lg
                               text-slate-300
                               hover:bg-red-500/10
                               hover:text-red-400
                               transition
                               text-left"
                    >

                        <i
                            data-lucide="log-out"
                            class="w-5 h-5 shrink-0"
                        ></i>

                        <span>
                            Logout
                        </span>

                    </button>

                </form>

            @endif

        </div>

    </aside>



    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main class="md:ml-64 flex-1 min-h-screen">


        {{-- =====================================================
             TOP BAR
        ====================================================== --}}

        <header
            class="bg-white
                   border-b border-slate-200
                   px-4 md:px-6
                   py-4
                   sticky top-0
                   z-40"
        >

            <div class="flex items-center justify-between gap-4">


                {{-- Mobile Menu --}}

                <button
                    type="button"
                    onclick="toggleSidebar()"
                    class="md:hidden
                           w-10 h-10
                           flex items-center justify-center
                           rounded-lg
                           bg-slate-100
                           hover:bg-slate-200"
                >

                    <i
                        data-lucide="menu"
                        class="w-5 h-5"
                    ></i>

                </button>


                {{-- Page Heading --}}

                <div class="min-w-0">

                    <h2
                        class="text-xl
                               font-semibold
                               text-slate-800
                               truncate"
                    >

                        @yield(
                            'page-heading',
                            'AuctionPro'
                        )

                    </h2>

                    <p
                        class="text-sm
                               text-slate-500
                               truncate"
                    >

                        @yield(
                            'page-description',
                            'Management System'
                        )

                    </p>

                </div>



                {{-- Right Side --}}

                <div class="flex items-center gap-3 ml-auto">


                    {{-- Search --}}

                   {{-- =====================================================
     GLOBAL SEARCH
====================================================== --}}

<div class="relative hidden sm:block">

    <div class="relative">

        <i
            data-lucide="search"
            class="absolute left-3 top-1/2
                   -translate-y-1/2
                   w-4 h-4
                   text-slate-400"
        ></i>

        <input
            id="global-search-input"
            type="text"
            autocomplete="off"
            placeholder="Search anything..."
            class="w-64 lg:w-80
                   pl-9 pr-9 py-2.5
                   border border-slate-200
                   rounded-xl
                   text-sm
                   bg-slate-50
                   focus:bg-white
                   focus:outline-none
                   focus:ring-2
                   focus:ring-indigo-500
                   focus:border-indigo-500"
        >

        <div
            id="global-search-loading"
            class="hidden absolute right-3 top-1/2
                   -translate-y-1/2"
        >

            <div
                class="w-4 h-4
                       border-2
                       border-slate-300
                       border-t-indigo-600
                       rounded-full
                       animate-spin"
            ></div>

        </div>

    </div>


    {{-- Search Results Dropdown --}}

    <div
        id="global-search-results"
        class="hidden
               absolute
               right-0
               top-full
               mt-2
               w-80 lg:w-96
               bg-white
               border border-slate-200
               rounded-2xl
               shadow-xl
               z-100
               overflow-hidden"
    >

        <div
            id="global-search-content"
            class="max-h-105 overflow-y-auto"
        ></div>

    </div>

</div>



                    {{-- Notification --}}

                    @if(Route::has('notifications.index'))

                        <a
                            href="{{ route('notifications.index') }}"
                            class="relative
                                   w-10 h-10
                                   flex items-center
                                   justify-center
                                   rounded-lg
                                   hover:bg-slate-100"
                        >

                            <i
                                data-lucide="bell"
                                class="w-5 h-5 text-slate-600"
                            ></i>

                        </a>

                    @endif



                    {{-- Top Avatar --}}

                    <div
                        class="w-10 h-10
                               bg-indigo-100
                               text-indigo-700
                               rounded-full
                               flex items-center
                               justify-center
                               font-bold
                               shrink-0"
                    >

                        @auth

                            {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}

                        @else

                            AD

                        @endauth

                    </div>

                </div>

            </div>

        </header>



        {{-- =====================================================
             PAGE CONTENT
        ====================================================== --}}

        <div class="p-6 md:p-8">


            {{-- Success Message --}}

            @if(session('success'))

                <div
                    class="mb-6
                           bg-green-50
                           border border-green-200
                           text-green-700
                           px-5 py-4
                           rounded-xl"
                >

                    {{ session('success') }}

                </div>

            @endif



            {{-- Error Message --}}

            @if(session('error'))

                <div
                    class="mb-6
                           bg-red-50
                           border border-red-200
                           text-red-700
                           px-5 py-4
                           rounded-xl"
                >

                    {{ session('error') }}

                </div>

            @endif



            @yield('content')


        </div>

    </main>

</div>



{{-- =============================================================
     MOBILE SIDEBAR OVERLAY
============================================================== --}}

<div
    id="sidebar-overlay"
    class="fixed inset-0
           bg-black/50
           z-40
           hidden md:hidden"
    onclick="toggleSidebar()"
></div>



{{-- =============================================================
     JAVASCRIPT
============================================================== --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | Lucide Icons
    |--------------------------------------------------------------------------
    */

    lucide.createIcons();


    /*
    |--------------------------------------------------------------------------
    | Mobile Sidebar
    |--------------------------------------------------------------------------
    */

    function toggleSidebar()
    {
        const sidebar =
            document.getElementById('sidebar');

        const overlay =
            document.getElementById('sidebar-overlay');


        if (!sidebar || !overlay) {
            return;
        }


        sidebar.classList.toggle('hidden');

        overlay.classList.toggle('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Close Mobile Sidebar After Clicking Link
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('#sidebar a')
        .forEach(function(link) {

            link.addEventListener('click', function() {

                if (window.innerWidth < 768) {

                    const sidebar =
                        document.getElementById('sidebar');

                    const overlay =
                        document.getElementById('sidebar-overlay');


                    if (sidebar && overlay) {

                        sidebar.classList.add('hidden');

                        overlay.classList.add('hidden');

                    }

                }

            });

        });

</script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('global-search-input');

    const resultsBox =
        document.getElementById('global-search-results');

    const resultsContent =
        document.getElementById('global-search-content');

    const loading =
        document.getElementById('global-search-loading');


    if (!searchInput || !resultsBox || !resultsContent) {
        return;
    }


    let searchTimer = null;


    /*
    |--------------------------------------------------------------------------
    | Search Input
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('input', function () {

        const query = this.value.trim();


        clearTimeout(searchTimer);


        if (query.length < 2) {

            resultsBox.classList.add('hidden');

            resultsContent.innerHTML = '';

            return;
        }


        loading.classList.remove('hidden');


        searchTimer = setTimeout(function () {

            fetch(
                `{{ route('global-search') }}?q=${encodeURIComponent(query)}`,
                {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            )
            .then(response => {

                if (!response.ok) {
                    throw new Error('Search request failed');
                }

                return response.json();

            })
            .then(data => {

                loading.classList.add('hidden');

                renderSearchResults(data.results || []);

            })
            .catch(error => {

                console.error(error);

                loading.classList.add('hidden');

                resultsContent.innerHTML = `
                    <div class="px-5 py-6 text-center">
                        <div class="text-red-500 mb-2">
                            <i data-lucide="alert-circle"
                               class="w-6 h-6 mx-auto"></i>
                        </div>

                        <p class="text-sm text-slate-500">
                            Unable to search right now.
                        </p>
                    </div>
                `;

                resultsBox.classList.remove('hidden');

                lucide.createIcons();

            });

        }, 300);

    });


    /*
    |--------------------------------------------------------------------------
    | Render Search Results
    |--------------------------------------------------------------------------
    */

    function renderSearchResults(results)
    {

        if (!results.length) {

            resultsContent.innerHTML = `

                <div class="px-5 py-8 text-center">

                    <div
                        class="w-12 h-12
                               mx-auto
                               bg-slate-100
                               rounded-full
                               flex items-center
                               justify-center
                               mb-3"
                    >

                        <i
                            data-lucide="search-x"
                            class="w-6 h-6
                                   text-slate-400"
                        ></i>

                    </div>

                    <p class="font-medium text-slate-700">
                        No results found
                    </p>

                    <p class="text-xs text-slate-400 mt-1">
                        Try a different search term.
                    </p>

                </div>

            `;

            resultsBox.classList.remove('hidden');

            lucide.createIcons();

            return;
        }


        let html = '';


        let currentType = '';


        results.forEach(function (result) {


            if (currentType !== result.type) {

                currentType = result.type;


                html += `

                    <div
                        class="px-4
                               pt-4
                               pb-2
                               text-[11px]
                               uppercase
                               tracking-wider
                               font-semibold
                               text-slate-400"
                    >
                        ${escapeHtml(result.type)}
                    </div>

                `;
            }


            html += `

                <a
                    href="${result.url}"
                    class="flex
                           items-center
                           gap-3
                           px-4
                           py-3
                           hover:bg-slate-50
                           transition
                           border-b
                           border-slate-50"
                >

                    <div
                        class="w-9 h-9
                               rounded-lg
                               bg-indigo-50
                               text-indigo-600
                               flex items-center
                               justify-center
                               shrink-0"
                    >

                        <i
                            data-lucide="${result.icon}"
                            class="w-4 h-4"
                        ></i>

                    </div>


                    <div class="min-w-0 flex-1">

                        <p
                            class="text-sm
                                   font-medium
                                   text-slate-800
                                   truncate"
                        >
                            ${escapeHtml(result.title)}
                        </p>

                        <p
                            class="text-xs
                                   text-slate-400
                                   truncate
                                   mt-0.5"
                        >
                            ${escapeHtml(result.subtitle || '')}
                        </p>

                    </div>


                    <i
                        data-lucide="chevron-right"
                        class="w-4 h-4
                               text-slate-300
                               shrink-0"
                    ></i>

                </a>

            `;
        });


        html += `

            <div
                class="px-4 py-3
                       bg-slate-50
                       text-center
                       text-xs
                       text-slate-400"
            >
                Showing matching results
            </div>

        `;


        resultsContent.innerHTML = html;

        resultsBox.classList.remove('hidden');

        lucide.createIcons();
    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value)
    {

        if (value === null || value === undefined) {
            return '';
        }


        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | Close Search When Clicking Outside
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        const searchContainer =
            searchInput.closest('.relative');


        if (
            searchContainer &&
            !searchContainer.contains(event.target)
        ) {

            resultsBox.classList.add('hidden');

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Escape Key
    |--------------------------------------------------------------------------
    */

    searchInput.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {

            resultsBox.classList.add('hidden');

            searchInput.blur();

        }

    });

});

</script>


</body>

</html>