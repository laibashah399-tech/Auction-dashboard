@extends('layouts.app')

@section('title', 'Edit Bidder')

@section('page-heading', 'Edit Bidder')

@section('page-description', 'Update bidder information.')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">

        <div class="mb-8">

            <h1 class="text-2xl font-bold text-slate-800">
                Edit Bidder
            </h1>

            <p class="text-slate-500 mt-1">
                Update the bidder's information.
            </p>

        </div>


        @if($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200
                        text-red-700 p-4 rounded-xl">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('bidders.update', $bidder) }}"
              method="POST">

            @csrf

            @method('PUT')


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Bidder Number
                    </label>

                    <input type="text"
                           name="bidder_number"
                           value="{{ old('bidder_number', $bidder->bidder_number) }}"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $bidder->name) }}"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $bidder->email) }}"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $bidder->phone) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold mb-2">
                        Address
                    </label>

                    <input type="text"
                           name="address"
                           value="{{ old('address', $bidder->address) }}"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Status
                    </label>

                    <select name="status"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl">

                        <option value="active"
                            {{ $bidder->status === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ $bidder->status === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('bidders.index') }}"
                   class="px-6 py-3 bg-slate-100 rounded-xl hover:bg-slate-200">

                    Cancel

                </a>

                <button type="submit"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                    Update Bidder

                </button>

            </div>

        </form>

    </div>

</div>

@endsection