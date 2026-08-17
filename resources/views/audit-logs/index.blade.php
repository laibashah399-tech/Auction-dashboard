@extends('layouts.app')

@section('title', 'Audit Logs - AuctionPro')

@section('page-heading', 'Audit Logs')

@section('page-description', 'Track important activities performed in AuctionPro.')

@section('content')

    <!-- ================================================= -->
    <!-- AUDIT LOGS HEADER -->
    <!-- ================================================= -->

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
                               hover:bg-red-100
                               transition">

                    <i data-lucide="trash-2"
                       class="w-4 h-4"></i>

                    Clear All Logs

                </button>

            </form>

        @endif

    </div>


    <!-- ================================================= -->
    <!-- STATISTICS -->
    <!-- ================================================= -->

    <div class="grid grid-cols-1
                sm:grid-cols-3
                gap-5 mb-8">


        <!-- TOTAL LOGS -->

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


        <!-- TODAY -->

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


        <!-- USER ACTIONS -->

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


    <!-- ================================================= -->
    <!-- FILTERS -->
    <!-- ================================================= -->

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


            <!-- SEARCH -->

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


            <!-- MODULE -->

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
                               outline-none
                               focus:ring-2
                               focus:ring-indigo-500">

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


            <!-- ACTION -->

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
                               outline-none
                               focus:ring-2
                               focus:ring-indigo-500">

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


            <!-- BUTTONS -->

            <div class="flex items-end gap-2">

                <button type="submit"
                        class="flex-1
                               bg-indigo-600
                               text-white
                               rounded-xl
                               px-4 py-2.5
                               hover:bg-indigo-700
                               transition">

                    Filter

                </button>


                <a href="{{ route('audit-logs.index') }}"
                   class="px-4 py-2.5
                          bg-gray-100
                          rounded-xl
                          hover:bg-gray-200
                          transition">

                    Reset

                </a>

            </div>

        </form>

    </div>


    <!-- ================================================= -->
    <!-- LOG TABLE -->
    <!-- ================================================= -->

    <div class="bg-white
                rounded-2xl
                border border-gray-100
                shadow-sm
                overflow-hidden">


        <!-- TABLE HEADER -->

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


        <!-- TABLE -->

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


                            <!-- IP ADDRESS -->

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
                                                   hover:bg-red-50
                                                   transition">

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

@endsection