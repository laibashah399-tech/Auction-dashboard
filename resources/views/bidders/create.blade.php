@extends('layouts.app')

@section('title', 'Add Bidder')

@section('page-heading', 'Add Bidder')

@section('page-description', 'Register a new bidder in AuctionPro.')

@section('content')

<div class="max-w-3xl">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">

        <div class="mb-8">

            <h1 class="text-2xl font-bold text-slate-800">
                Add New Bidder
            </h1>

            <p class="text-slate-500 mt-1">
                Enter the bidder's information below.
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


        <form action="{{ route('bidders.store') }}"
              method="POST">

            @csrf


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Bidder Number
                    </label>

                    <input type="text"
                           name="bidder_number"
                           value="{{ old('bidder_number', 'BD-' . rand(1000, 9999)) }}"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Enter bidder name"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="bidder@example.com"
                           required
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Phone
                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="+92 300 1234567"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-semibold mb-2">
                        Address
                    </label>

                    <input type="text"
                           name="address"
                           value="{{ old('address') }}"
                           placeholder="Enter bidder address"
                           class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                </div>


                <div>

                    <label class="block text-sm font-semibold mb-2">
                        Status
                    </label>

                    <select name="status"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
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

                    Add Bidder

                </button>

            </div>

        </form>

    </div>

</div>

@endsection