<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Import Lots - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

</head>


<body class="bg-gray-50">


<div class="min-h-screen">


    <!-- Sidebar -->

    <aside class="fixed left-0 top-0 h-full w-64 bg-slate-900 text-white">

        <div class="p-6">

            <h1 class="text-2xl font-bold">
                AuctionPro
            </h1>

            <p class="text-slate-400 text-sm">
                Management System
            </p>

        </div>


        <nav class="px-4 space-y-2">


            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800"
            >

                <i data-lucide="layout-dashboard"></i>

                Dashboard

            </a>


            <a
                href="{{ route('auctions.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800"
            >

                <i data-lucide="gavel"></i>

                Auctions

            </a>


            <a
                href="#"
                class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-slate-800"
            >

                <i data-lucide="package"></i>

                Lots

            </a>


            <a
                href="{{ route('imports.index') }}"
                class="flex items-center gap-3 px-3 py-3 rounded-lg bg-indigo-600"
            >

                <i data-lucide="upload"></i>

                Bulk Imports

            </a>


        </nav>

    </aside>



    <!-- Main -->

    <main class="ml-64">


        <header class="bg-white border-b px-8 py-5">

            <h2 class="text-xl font-semibold">

                Bulk Import Lots

            </h2>

            <p class="text-sm text-gray-500">

                Import multiple lots into an auction using CSV.

            </p>

        </header>



        <div class="p-8">


            <div class="max-w-4xl mx-auto">


                <a
                    href="{{ route('imports.index') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-indigo-600 mb-6"
                >

                    <i data-lucide="arrow-left" class="w-4 h-4"></i>

                    Back to Imports

                </a>



                <div class="bg-white rounded-2xl shadow-sm border p-8">


                    <div class="mb-8">

                        <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-4">

                            <i
                                data-lucide="file-up"
                                class="w-7 h-7"
                            ></i>

                        </div>


                        <h1 class="text-2xl font-bold">

                            Import Lots

                        </h1>


                        <p class="text-gray-500 mt-1">

                            Upload a CSV file to create multiple lots automatically.

                        </p>

                    </div>



                    @if($errors->any())

                        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">

                            @foreach($errors->all() as $error)

                                <p>{{ $error }}</p>

                            @endforeach

                        </div>

                    @endif



                    <form
                        action="{{ route('imports.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf



                        <!-- Auction -->

                        <div class="mb-6">

                            <label class="block font-semibold mb-2">

                                Select Auction

                            </label>


                            <select
                                name="auction_id"
                                required
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500"
                            >

                                <option value="">

                                    Select an auction

                                </option>


                                @foreach($auctions as $auction)

                                    <option
                                        value="{{ $auction->id }}"
                                    >

                                        {{ $auction->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>



                        <!-- File -->

                        <div class="mb-8">


                            <label class="block font-semibold mb-2">

                                CSV File

                            </label>


                            <label
                                class="border-2 border-dashed border-gray-300 rounded-2xl p-10 flex flex-col items-center justify-center cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 transition"
                            >


                                <i
                                    data-lucide="upload-cloud"
                                    class="w-12 h-12 text-indigo-500 mb-4"
                                ></i>


                                <p class="font-semibold">

                                    Click to upload CSV

                                </p>


                                <p class="text-sm text-gray-500 mt-1">

                                    CSV or TXT file up to 5MB

                                </p>


                                <input
                                    type="file"
                                    name="csv_file"
                                    accept=".csv,.txt"
                                    required
                                    class="hidden"
                                >


                            </label>

                        </div>



                        <!-- CSV Format -->

                        <div class="bg-gray-50 rounded-xl p-5 mb-8">


                            <h3 class="font-semibold mb-3">

                                CSV Format

                            </h3>


                            <p class="text-sm text-gray-500 mb-3">

                                Your CSV file should contain these columns:

                            </p>


                            <code class="text-sm text-indigo-600 break-all">

                                lot_number,title,description,starting_price,current_bid,status,image

                            </code>


                            <div class="mt-4 text-xs text-gray-500">

                                Example:

                                <br>

                                LOT-1001,Antique Vase,Beautiful antique vase,500,750,available,vase.jpg

                            </div>


                        </div>



                        <!-- Buttons -->

                        <div class="flex justify-end gap-3">


                            <a
                                href="{{ route('imports.index') }}"
                                class="px-6 py-3 bg-gray-100 rounded-xl hover:bg-gray-200"
                            >

                                Cancel

                            </a>


                            <button
                                type="submit"
                                class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700"
                            >

                                <i
                                    data-lucide="upload"
                                    class="w-5 h-5"
                                ></i>

                                Start Import

                            </button>


                        </div>


                    </form>


                </div>


            </div>

        </div>

    </main>

</div>


<script>

    lucide.createIcons();

</script>


</body>

</html>