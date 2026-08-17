@extends('layouts.app')

@section('title', 'Notifications - AuctionPro')

@section('page-heading', 'Notifications')

@section('page-description', 'Manage your system notifications and alerts.')

@section('content')

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Notifications
            </h2>

            <p class="text-gray-500 mt-1">
                Manage your system notifications and alerts.
            </p>
        </div>


        <div class="flex gap-3">

            {{-- MARK ALL READ --}}
            @if($unreadCount > 0)

                <form method="POST"
                      action="{{ route('notifications.read-all') }}">

                    @csrf

                    <button type="submit"
                            class="flex items-center gap-2
                                   px-4 py-2.5
                                   bg-indigo-600
                                   text-white
                                   rounded-xl
                                   hover:bg-indigo-700
                                   transition">

                        <i data-lucide="check-check"
                           class="w-4 h-4"></i>

                        Mark All Read

                    </button>

                </form>

            @endif


            {{-- CLEAR ALL --}}
            @if($notifications->total() > 0)

                <form method="POST"
                      action="{{ route('notifications.destroy-all') }}"
                      onsubmit="return confirm('Delete all notifications?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="flex items-center gap-2
                                   px-4 py-2.5
                                   bg-red-50
                                   text-red-600
                                   rounded-xl
                                   hover:bg-red-100
                                   transition">

                        <i data-lucide="trash-2"
                           class="w-4 h-4"></i>

                        Clear All

                    </button>

                </form>

            @endif

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUMMARY CARDS --}}
    {{-- ========================================================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">


        {{-- TOTAL --}}
        <div class="bg-white rounded-2xl p-5
                    border border-gray-100
                    shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12
                            bg-indigo-100
                            text-indigo-600
                            rounded-xl
                            flex items-center
                            justify-center">

                    <i data-lucide="bell"
                       class="w-6 h-6"></i>

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


        {{-- UNREAD --}}
        <div class="bg-white rounded-2xl p-5
                    border border-gray-100
                    shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12
                            bg-red-100
                            text-red-600
                            rounded-xl
                            flex items-center
                            justify-center">

                    <i data-lucide="mail"
                       class="w-6 h-6"></i>

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


        {{-- READ --}}
        <div class="bg-white rounded-2xl p-5
                    border border-gray-100
                    shadow-sm">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12
                            bg-green-100
                            text-green-600
                            rounded-xl
                            flex items-center
                            justify-center">

                    <i data-lucide="mail-check"
                       class="w-6 h-6"></i>

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


    {{-- ========================================================= --}}
    {{-- NOTIFICATIONS LIST --}}
    {{-- ========================================================= --}}

    <div class="bg-white rounded-2xl
                border border-gray-100
                shadow-sm">


        {{-- LIST HEADER --}}
        <div class="p-6 border-b border-gray-100">

            <h3 class="text-lg font-bold">
                All Notifications
            </h3>

            <p class="text-sm text-gray-500 mt-1">
                Recent system alerts and activities.
            </p>

        </div>


        {{-- NOTIFICATIONS --}}
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


                {{-- NOTIFICATION ITEM --}}
                <div class="p-6
                    {{ is_null($notification->read_at)
                        ? 'bg-indigo-50/40'
                        : 'bg-white' }}">


                    <div class="flex items-start gap-4">


                        {{-- ICON --}}
                        <div class="w-12 h-12 shrink-0
                                    rounded-xl
                                    flex items-center
                                    justify-center

                            @if($type === 'success')
                                bg-emerald-50 text-emerald-700

                            @elseif($type === 'warning')
                                bg-amber-50 text-amber-700

                            @elseif($type === 'error')
                                bg-rose-50 text-rose-700

                            @elseif($type === 'auction')
                                bg-violet-50 text-violet-600

                            @elseif($type === 'bid')
                                bg-fuchsia-50 text-fuchsia-600

                            @elseif($type === 'payment')
                                bg-cyan-50 text-cyan-600

                            @elseif($type === 'user')
                                bg-teal-50 text-teal-600

                            @else
                                bg-slate-100 text-slate-600
                            @endif
                        ">

                            <i data-lucide="{{ $icon }}"
                               class="w-6 h-6"></i>

                        </div>


                        {{-- CONTENT --}}
                        <div class="flex-1 min-w-0">

                            <div class="flex items-start
                                        justify-between
                                        gap-4">


                                {{-- TEXT --}}
                                <div>

                                    <div class="flex items-center gap-2">

                                        <h4 class="font-semibold text-gray-900">

                                            {{ $title }}

                                        </h4>


                                        {{-- NEW --}}
                                        @if(is_null($notification->read_at))

                                            <span class="px-2 py-1
                                                         text-xs
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


                                {{-- ACTIONS --}}
                                <div class="flex items-center gap-2">


                                    {{-- MARK AS READ --}}
                                    @if(is_null($notification->read_at))

                                        <form method="POST"
                                              action="{{ route('notifications.read', $notification->id) }}">

                                            @csrf

                                            <button type="submit"
                                                    title="Mark as read"
                                                    class="p-2
                                                           rounded-lg
                                                           text-gray-500
                                                           hover:text-green-600
                                                           hover:bg-green-50
                                                           transition">

                                                <i data-lucide="check"
                                                   class="w-5 h-5"></i>

                                            </button>

                                        </form>

                                    @endif


                                    {{-- DELETE --}}
                                    <form method="POST"
                                          action="{{ route('notifications.destroy', $notification->id) }}"
                                          onsubmit="return confirm('Delete this notification?');">

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

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            @empty

                {{-- EMPTY STATE --}}
                <div class="py-16 text-center">

                    <div class="w-16 h-16
                                bg-gray-100
                                text-gray-400
                                rounded-full
                                flex items-center
                                justify-center
                                mx-auto">

                        <i data-lucide="bell-off"
                           class="w-8 h-8"></i>

                    </div>


                    <h3 class="text-lg
                               font-semibold
                               text-gray-900
                               mt-4">

                        No Notifications

                    </h3>


                    <p class="text-sm
                              text-gray-500
                              mt-1">

                        You're all caught up!

                    </p>

                </div>

            @endforelse

        </div>


        {{-- ===================================================== --}}
        {{-- PAGINATION --}}
        {{-- ===================================================== --}}

        @if($notifications->hasPages())

            <div class="p-6 border-t border-gray-100">

                {{ $notifications->links() }}

            </div>

        @endif

    </div>

@endsection