@extends('layouts.app')

@section('title', 'Lots')

@section('page-heading', 'Lots')

@section('page-description', 'Manage all auction lots.')

@section('content')

<div class="space-y-6">

{{-- Header --}}
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

    <div>
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"/>
                </svg>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    All Lots
                </h1>

                <p class="text-sm text-slate-500 mt-0.5">
                    Manage your auction lots, prices and images.
                </p>
            </div>
        </div>
    </div>

    <a
        href="{{ route('lots.create') }}"
        class="inline-flex items-center justify-center gap-2 px-5 py-3
               bg-indigo-600 text-white rounded-xl font-semibold
               shadow-sm hover:bg-indigo-700 hover:shadow-md
               transition-all duration-200"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4v16m8-8H4"/>
        </svg>

        Create Lot
    </a>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="flex items-center gap-3 bg-emerald-50 border border-emerald-200
                text-emerald-700 px-5 py-4 rounded-xl">

        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"/>
        </svg>

        <span class="text-sm font-medium">
            {{ session('success') }}
        </span>

    </div>

@endif


{{-- Main Card --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    {{-- Card Header --}}
    <div class="px-6 py-5 border-b border-slate-200">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h2 class="text-lg font-bold text-slate-800">
                    Auction Lots
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    View and manage your auction inventory.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 px-3 py-2
                        bg-slate-50 border border-slate-200 rounded-lg">

                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>

                <span class="text-sm font-semibold text-slate-600">
                    {{ $lots->total() }} Total Lots
                </span>

            </div>

        </div>

    </div>


    {{-- Table Wrapper --}}
    {{-- IMPORTANT: This wrapper handles horizontal scrolling only.
         Nothing inside the table is sticky/fixed. --}}
    <div class="w-full overflow-x-auto">

        <table class="w-full min-w-[1100px]">

            <thead class="bg-slate-50 border-b border-slate-200">

                <tr>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider w-[180px]">
                        Image
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider min-w-[220px]">
                        Lot
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider min-w-[150px]">
                        Auction
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Starting Price
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Current Bid
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Bids
                    </th>

                    <th class="px-5 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">
                        Status
                    </th>

                    <th class="px-5 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider min-w-[220px]">
                        Actions
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-slate-100">

                @forelse($lots as $lot)

                    <tr class="group hover:bg-slate-50/80 transition-colors duration-150">


                        {{-- IMAGE --}}

<td class="px-5 py-5 align-middle">

    @php
        $galleryImages = [];

        /*
        |--------------------------------------------------------------------------
        | Main image
        |--------------------------------------------------------------------------
        */

        if (
            $lot->image &&
            Storage::disk('public')->exists($lot->image)
        ) {
            $galleryImages[] = asset(
                'storage/' . $lot->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Additional images
        |--------------------------------------------------------------------------
        */

        foreach ($lot->images as $lotImage) {

            if (
                $lotImage->image &&
                Storage::disk('public')->exists(
                    $lotImage->image
                )
            ) {

                $imageUrl = asset(
                    'storage/' . $lotImage->image
                );

                /*
                |--------------------------------------------------------------------------
                | Prevent duplicate main image
                |--------------------------------------------------------------------------
                */

                if (!in_array($imageUrl, $galleryImages)) {
                    $galleryImages[] = $imageUrl;
                }
            }
        }
    @endphp


    @if(count($galleryImages) > 0)

        <button
            type="button"
            onclick='showLotGallery(
                @json($galleryImages),
                @json($lot->lot_number),
                @json($lot->title)
            )'
            class="block focus:outline-none"
        >

            <div class="relative">

                {{-- Only FIRST image thumbnail --}}
                <img
                    src="{{ $galleryImages[0] }}"
                    alt="{{ $lot->title }}"
                    class="w-16 h-16 object-cover rounded-xl
                           border border-slate-200
                           shadow-sm
                           hover:shadow-md
                           hover:scale-105
                           transition-all duration-200"
                >

                {{-- Image count --}}
                @if(count($galleryImages) > 1)

                    <span
                        class="absolute -right-2 -top-2
                               min-w-6 h-6 px-1.5
                               flex items-center justify-center
                               rounded-full
                               bg-indigo-600
                               text-white
                               text-[10px]
                               font-bold
                               shadow"
                    >
                        {{ count($galleryImages) }}
                    </span>

                @endif

            </div>

        </button>

    @elseif($lot->image)

        <div
            class="w-16 h-16 rounded-xl
                   bg-red-50 border border-red-100
                   flex items-center justify-center"
        >

            <svg
                class="w-6 h-6 text-red-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 9v3m0 4h.01M10.3 4.6L2.9 17.4A2 2 0 004.6 20h14.8a2 2 0 001.7-2.6L13.7 4.6a2 2 0 00-3.4 0z"
                />
            </svg>

        </div>

    @else

        <div
            class="w-16 h-16 rounded-xl
                   bg-slate-100 border border-slate-200
                   flex items-center justify-center"
        >

            <svg
                class="w-6 h-6 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M4 16l4.5-5 3.5 4 2.5-3 5.5 6M5 20h14a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v14a1 1 0 001 1z"
                />
            </svg>

        </div>

    @endif

</td>



                        {{-- LOT --}}
                        <td class="px-5 py-5 align-middle">

                            <div class="flex items-center gap-3">

                                <div class="flex-shrink-0 w-9 h-9 rounded-lg
                                            bg-indigo-50 text-indigo-600
                                            flex items-center justify-center
                                            text-xs font-bold">

                                    #{{ $lot->lot_number }}

                                </div>

                                <div class="min-w-0">

                                    <a
                                        href="{{ route('lots.show', $lot) }}"
                                        class="block font-semibold text-slate-800
                                               hover:text-indigo-600
                                               transition-colors truncate max-w-[230px]"
                                    >
                                        {{ $lot->title }}
                                    </a>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Lot #{{ $lot->lot_number }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- AUCTION --}}
                        <td class="px-5 py-5 align-middle">

                            <span class="inline-flex items-center px-3 py-1.5
                                         rounded-lg bg-slate-100
                                         text-sm font-medium text-slate-600">

                                {{ $lot->auction->name ?? 'No Auction' }}

                            </span>

                        </td>


                        {{-- STARTING PRICE --}}
                        <td class="px-5 py-5 align-middle">

                            <span class="font-semibold text-slate-700 whitespace-nowrap">
                                £{{ number_format($lot->starting_price, 2) }}
                            </span>

                        </td>


                        {{-- CURRENT BID --}}
                        <td class="px-5 py-5 align-middle">

                            <div>

                                <span class="font-bold text-indigo-600 whitespace-nowrap">
                                    £{{ number_format($lot->current_bid, 2) }}
                                </span>

                                @if($lot->current_bid > $lot->starting_price)

                                    <p class="text-[11px] text-emerald-600 font-medium mt-1 whitespace-nowrap">
                                        ↑ Above starting price
                                    </p>

                                @endif

                            </div>

                        </td>


                        {{-- BIDS --}}
                        <td class="px-5 py-5 align-middle">

                            <span class="inline-flex min-w-9 h-9 px-2
                                         items-center justify-center
                                         rounded-lg bg-slate-100
                                         text-sm font-bold text-slate-600">

                                {{ $lot->bids_count }}

                            </span>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 py-5 align-middle">

                            @if($lot->status === 'available')

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1.5 rounded-full
                                             bg-blue-50 text-blue-700
                                             border border-blue-100
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                    Available

                                </span>

                            @elseif($lot->status === 'sold')

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1.5 rounded-full
                                             bg-emerald-50 text-emerald-700
                                             border border-emerald-100
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                    Sold

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2
                                             px-3 py-1.5 rounded-full
                                             bg-red-50 text-red-700
                                             border border-red-100
                                             text-xs font-bold">

                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                    Unsold

                                </span>

                            @endif

                        </td>


                        {{-- ACTIONS --}}
                        <td class="px-5 py-5 align-middle">

                            <div class="flex justify-end items-center gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('lots.show', $lot) }}"
                                    class="inline-flex items-center gap-1.5
                                           px-3 py-2 rounded-lg
                                           bg-slate-100 text-slate-700
                                           hover:bg-slate-200
                                           text-sm font-medium
                                           transition-colors"
                                >
                                    View
                                </a>


                                {{-- Edit --}}
                                <a
                                    href="{{ route('lots.edit', $lot) }}"
                                    class="inline-flex items-center gap-1.5
                                           px-3 py-2 rounded-lg
                                           bg-indigo-50 text-indigo-700
                                           hover:bg-indigo-100
                                           text-sm font-medium
                                           transition-colors"
                                >
                                    Edit
                                </a>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('lots.destroy', $lot) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this lot?');"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-2 rounded-lg
                                               bg-red-50 text-red-700
                                               hover:bg-red-100
                                               text-sm font-medium
                                               transition-colors"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="px-6 py-16 text-center">

                            <div class="flex flex-col items-center">

                                <div class="w-16 h-16 rounded-2xl bg-slate-100
                                            flex items-center justify-center mb-4">

                                    <svg class="w-8 h-8 text-slate-400" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="1.8"
                                              d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m-8-4l8 4m0 0v10"/>
                                    </svg>

                                </div>

                                <p class="text-lg font-bold text-slate-700">
                                    No lots found
                                </p>

                                <p class="text-sm text-slate-400 mt-1">
                                    Create your first lot to get started.
                                </p>

                                <a
                                    href="{{ route('lots.create') }}"
                                    class="mt-5 inline-flex items-center gap-2
                                           px-5 py-2.5 bg-indigo-600
                                           text-white rounded-xl
                                           font-semibold hover:bg-indigo-700"
                                >
                                    + Create Lot
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($lots->hasPages())

        <div class="px-6 py-5 border-t border-slate-200 bg-white">

            {{ $lots->links() }}

        </div>

    @endif

</div>


</div>


{{-- IMAGE GALLERY MODAL --}}

<div
    id="lotImageModal"
    class="fixed inset-0 z-[9999] hidden"
    aria-hidden="true"
>

    {{-- Background --}}
    <div
        class="absolute inset-0 bg-black/80 backdrop-blur-sm"
        onclick="hideLotGallery()"
    ></div>


    {{-- Modal --}}
    <div
        class="relative z-10
               w-full h-full
               flex items-center justify-center
               p-4 sm:p-8"
    >

        <div
            class="relative
                   w-full max-w-5xl
                   max-h-[95vh]
                   bg-white
                   rounded-2xl
                   shadow-2xl
                   overflow-hidden
                   flex flex-col"
        >

            {{-- Header --}}
            <div
                class="flex items-center justify-between
                       gap-4
                       px-5 py-4
                       border-b border-slate-200"
            >

                <div class="min-w-0">

                    <p
                        id="lotModalNumber"
                        class="text-xs font-bold
                               text-indigo-600 uppercase"
                    ></p>

                    <h2
                        id="lotModalTitle"
                        class="text-lg sm:text-xl
                               font-bold text-slate-800
                               truncate"
                    ></h2>

                </div>


                <button
                    type="button"
                    onclick="hideLotGallery()"
                    class="flex-shrink-0
                           w-10 h-10
                           rounded-full
                           bg-slate-100
                           text-slate-700
                           text-2xl
                           hover:bg-slate-200
                           transition"
                >
                    ×
                </button>

            </div>


            {{-- Image Area --}}
            <div
                class="relative
                       flex-1
                       bg-slate-950
                       min-h-[400px]
                       flex items-center justify-center"
            >

                <img
                    id="lotModalImage"
                    src=""
                    alt=""
                    class="max-w-full
                           max-h-[70vh]
                           object-contain
                           select-none"
                >


                {{-- Previous --}}
                <button
                    id="lotPrevButton"
                    type="button"
                    onclick="previousLotImage()"
                    class="absolute left-4
                           w-11 h-11
                           rounded-full
                           bg-white/90
                           text-slate-800
                           text-2xl
                           shadow-lg
                           hover:bg-white
                           transition"
                >
                    ‹
                </button>


                {{-- Next --}}
                <button
                    id="lotNextButton"
                    type="button"
                    onclick="nextLotImage()"
                    class="absolute right-4
                           w-11 h-11
                           rounded-full
                           bg-white/90
                           text-slate-800
                           text-2xl
                           shadow-lg
                           hover:bg-white
                           transition"
                >
                    ›
                </button>

            </div>


            {{-- Footer --}}
            <div
                class="flex items-center
                       justify-center
                       gap-3
                       px-5 py-4
                       border-t border-slate-200
                       bg-white"
            >

                <span
                    id="lotImageCounter"
                    class="text-sm font-semibold
                           text-slate-600"
                >
                </span>

            </div>

        </div>

    </div>

</div>


<script>

    let lotGalleryImages = [];
    let currentLotImageIndex = 0;


    function showLotGallery(images, lotNumber, title)
    {
        lotGalleryImages = images || [];
        currentLotImageIndex = 0;

        if (lotGalleryImages.length === 0) {
            return;
        }

        document.getElementById('lotModalNumber').textContent =
            'Lot #' + lotNumber;

        document.getElementById('lotModalTitle').textContent =
            title;

        updateLotGallery();

        const modal =
            document.getElementById('lotImageModal');

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');
    }


    function updateLotGallery()
    {
        const image =
            document.getElementById('lotModalImage');

        const counter =
            document.getElementById('lotImageCounter');

        const previous =
            document.getElementById('lotPrevButton');

        const next =
            document.getElementById('lotNextButton');


        image.src =
            lotGalleryImages[currentLotImageIndex];


        counter.textContent =
            `${currentLotImageIndex + 1} / ${lotGalleryImages.length}`;


        /*
        |--------------------------------------------------------------------------
        | Hide navigation when only one image exists
        |--------------------------------------------------------------------------
        */

        if (lotGalleryImages.length <= 1) {

            previous.classList.add('hidden');
            next.classList.add('hidden');

        } else {

            previous.classList.remove('hidden');
            next.classList.remove('hidden');
        }
    }


    function previousLotImage()
    {
        if (lotGalleryImages.length <= 1) {
            return;
        }

        currentLotImageIndex--;

        if (currentLotImageIndex < 0) {
            currentLotImageIndex =
                lotGalleryImages.length - 1;
        }

        updateLotGallery();
    }


    function nextLotImage()
    {
        if (lotGalleryImages.length <= 1) {
            return;
        }

        currentLotImageIndex++;

        if (
            currentLotImageIndex >=
            lotGalleryImages.length
        ) {
            currentLotImageIndex = 0;
        }

        updateLotGallery();
    }


    function hideLotGallery()
    {
        const modal =
            document.getElementById('lotImageModal');

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

        document.getElementById('lotModalImage').src = '';

        lotGalleryImages = [];
        currentLotImageIndex = 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Keyboard navigation
    |--------------------------------------------------------------------------
    */

    document.addEventListener('keydown', function(event) {

        const modal =
            document.getElementById('lotImageModal');

        if (
            !modal ||
            modal.classList.contains('hidden')
        ) {
            return;
        }


        if (event.key === 'Escape') {
            hideLotGallery();
        }


        if (event.key === 'ArrowLeft') {
            previousLotImage();
        }


        if (event.key === 'ArrowRight') {
            nextLotImage();
        }

    });

</script>




@endsection
