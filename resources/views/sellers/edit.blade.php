@extends('layouts.app')

@section('title', 'Edit Seller')
@section('page-heading', 'Edit Seller')
@section('page-description', 'Update seller information.')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl border border-slate-200">

        <div class="p-6 border-b border-slate-200">

            <h2 class="text-xl font-bold">
                Edit Seller
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Update {{ $seller->name }}'s information.
            </p>

        </div>


        <form
            action="{{ route('sellers.update', $seller) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Seller Name *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $seller->name) }}"
                        required
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               focus:outline-none">

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $seller->email) }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               focus:outline-none">

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $seller->phone) }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               focus:outline-none">

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Company
                    </label>

                    <input
                        type="text"
                        name="company"
                        value="{{ old('company', $seller->company) }}"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl focus:ring-2 focus:ring-indigo-500
                               focus:outline-none">

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl">

                        <option value="active"
                            {{ $seller->status === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ $seller->status === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl">{{ old('address', $seller->address) }}</textarea>

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="4"
                        class="w-full px-4 py-3 border border-slate-200
                               rounded-xl">{{ old('notes', $seller->notes) }}</textarea>

                </div>

            </div>


            <div class="p-6 border-t border-slate-200 flex justify-end gap-3">

                <a
                    href="{{ route('sellers.index') }}"
                    class="px-5 py-3 border border-slate-200 rounded-xl">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-5 py-3 bg-indigo-600 text-white rounded-xl
                           hover:bg-indigo-700">

                    Update Seller

                </button>

            </div>

        </form>

    </div>

</div>

@endsection