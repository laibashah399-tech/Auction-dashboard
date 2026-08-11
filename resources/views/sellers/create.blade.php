@extends('layouts.app')

@section('title', 'Add Seller')
@section('page-heading', 'Add Seller')
@section('page-description', 'Create a new seller profile.')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl border border-slate-200">

        <div class="p-6 border-b border-slate-200">

            <h2 class="text-xl font-bold text-slate-900">
                Seller Information
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Enter the seller's information below.
            </p>

        </div>


        <form action="{{ route('sellers.store') }}" method="POST">

            @csrf

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Name --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Seller Name *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">

                    @error('name')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Email --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">

                    @error('email')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Phone --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">

                </div>


                {{-- Company --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Company
                    </label>

                    <input
                        type="text"
                        name="company"
                        value="{{ old('company') }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Status *
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Address --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">{{ old('address') }}</textarea>

                </div>


                {{-- Notes --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="4"
                        placeholder="Additional information about seller..."
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:outline-none focus:ring-2
                               focus:ring-indigo-500">{{ old('notes') }}</textarea>

                </div>

            </div>


            <div class="p-6 border-t border-slate-200 flex justify-end gap-3">

                <a
                    href="{{ route('sellers.index') }}"
                    class="px-5 py-3 border border-slate-200 rounded-xl
                           hover:bg-slate-50">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-5 py-3 bg-indigo-600 text-white rounded-xl
                           hover:bg-indigo-700">

                    Save Seller

                </button>

            </div>

        </form>

    </div>

</div>

@endsection