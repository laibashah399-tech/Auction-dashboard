@extends('layouts.app')

@section('title', 'Settings - AuctionPro')

@section('page-heading', 'Settings')

@section('page-description', 'Manage AuctionPro system settings and preferences.')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- ========================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================================================= --}}

    <div class="mb-8">

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            Settings
        </h1>

        <p class="text-gray-500 mt-1">
            Manage AuctionPro system settings and preferences.
        </p>

    </div>


    {{-- ========================================================= --}}
    {{-- SETTINGS FORM --}}
    {{-- ========================================================= --}}

    <form method="POST"
          action="{{ route('settings.update') }}">

        @csrf

        @method('PUT')


        {{-- ===================================================== --}}
        {{-- GENERAL SETTINGS --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6">


            {{-- Section Header --}}

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

                        <h2 class="text-lg font-bold text-gray-900">
                            General Settings
                        </h2>

                        <p class="text-sm text-gray-500">
                            Basic information about your AuctionPro system.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Fields --}}

            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- Site Name --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Site Name
                        </label>

                        <input
                            type="text"
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


                    {{-- Admin Email --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Admin Email
                        </label>

                        <input
                            type="email"
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


                    {{-- Phone --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>

                        <input
                            type="text"
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


                    {{-- Currency --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Currency
                        </label>

                        <select
                            name="currency"
                            class="w-full px-4 py-3
                                   border border-gray-300
                                   rounded-xl
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-indigo-500
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


                    {{-- Timezone --}}

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Timezone
                        </label>

                        <select
                            name="timezone"
                            class="w-full px-4 py-3
                                   border border-gray-300
                                   rounded-xl
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-indigo-500
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


                    {{-- Site Description --}}

                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Site Description
                        </label>

                        <textarea
                            name="site_description"
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


        {{-- ===================================================== --}}
        {{-- NOTIFICATION SETTINGS --}}
        {{-- ===================================================== --}}

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6">


            {{-- Section Header --}}

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

                        <h2 class="text-lg font-bold text-gray-900">
                            Notification Settings
                        </h2>

                        <p class="text-sm text-gray-500">
                            Control how AuctionPro notifications work.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Notification Options --}}

            <div class="divide-y divide-gray-100">


                {{-- Email Notifications --}}

                <div class="p-6 flex items-center justify-between gap-4">

                    <div>

                        <h3 class="font-semibold text-gray-900">
                            Email Notifications
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Allow the system to send notification emails.
                        </p>

                    </div>


                    <label class="relative inline-flex items-center cursor-pointer">

                        <input
                            type="checkbox"
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


                {{-- System Notifications --}}

                <div class="p-6 flex items-center justify-between gap-4">

                    <div>

                        <h3 class="font-semibold text-gray-900">
                            System Notifications
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Show automatic activity notifications in AuctionPro.
                        </p>

                    </div>


                    <label class="relative inline-flex items-center cursor-pointer">

                        <input
                            type="checkbox"
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


                {{-- Auction Auto Approval --}}

                <div class="p-6 flex items-center justify-between gap-4">

                    <div>

                        <h3 class="font-semibold text-gray-900">
                            Auction Auto Approval
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Automatically approve new auctions when they are created.
                        </p>

                    </div>


                    <label class="relative inline-flex items-center cursor-pointer">

                        <input
                            type="checkbox"
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


        {{-- ===================================================== --}}
        {{-- SAVE BUTTON --}}
        {{-- ===================================================== --}}

        <div class="flex justify-end">

            <button
                type="submit"
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

</div>


{{-- ========================================================= --}}
{{-- PAGE-SPECIFIC ICON INITIALIZATION --}}
{{-- ========================================================= --}}

@push('scripts')
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
@endpush

@endsection