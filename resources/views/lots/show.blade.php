<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $lot->title }} - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>    
@php
    use Illuminate\Support\Facades\Storage;
@endphp


<body class="bg-slate-100">


<div class="min-h-screen">


    <!-- Header -->

    <header class="bg-white border-b border-slate-200">

        <div class="max-w-6xl mx-auto px-6 py-5">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-2xl font-bold text-slate-800">
                        Lot Details
                    </h1>

                    <p class="text-sm text-slate-500">
                        Complete information about this auction lot
                    </p>

                </div>


                <a
                    href="{{ route('lots.index') }}"
                    class="px-4 py-2.5 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200"
                >
                    ← Back to Lots
                </a>

            </div>

        </div>

    </header>



    <!-- Main -->

    <main class="max-w-6xl mx-auto px-6 py-8">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


           

        
<!-- Images -->

<div class="bg-white rounded-2xl shadow-sm p-6">

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
            class="w-full focus:outline-none"
        >

            <img
                src="{{ $galleryImages[0] }}"
                alt="{{ $lot->title }}"
                class="w-full h-80
                       object-cover
                       rounded-xl
                       hover:opacity-95
                       transition"
            >

        </button>


        {{-- Image count --}}

        @if(count($galleryImages) > 1)

            <div class="mt-3 text-center">

                <span
                    class="inline-flex items-center
                           px-3 py-1.5
                           rounded-full
                           bg-indigo-50
                           text-indigo-600
                           text-xs
                           font-semibold"
                >
                    {{ count($galleryImages) }} Images
                </span>

            </div>

        @endif


    @else

        <div
            class="w-full h-80
                   bg-slate-100
                   rounded-xl
                   flex items-center
                   justify-center"
        >

            <span class="text-slate-400">
                No Image Available
            </span>

        </div>

    @endif

</div>


            <!-- Details -->

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-8">


                <div class="flex justify-between items-start gap-4 mb-6">


                    <div>

                        <p class="text-sm text-indigo-600 font-semibold">
                            Lot #{{ $lot->lot_number }}
                        </p>

                        <h2 class="text-3xl font-bold text-slate-800 mt-1">
                            {{ $lot->title }}
                        </h2>

                    </div>


                    <span class="px-4 py-2 rounded-full text-sm font-semibold

                        @if($lot->status === 'sold')
                            bg-emerald-100 text-emerald-700
                        @elseif($lot->status === 'available')
                            bg-blue-100 text-blue-700
                        @else
                            bg-red-100 text-red-700
                        @endif
                    ">

                        {{ ucfirst($lot->status) }}

                    </span>


                </div>



                <div class="mb-8">

                    <h3 class="font-semibold text-slate-800 mb-2">
                        Description
                    </h3>

                    <p class="text-slate-600 leading-relaxed">

                        {{ $lot->description ?: 'No description available.' }}

                    </p>

                </div>



                <!-- Price Cards -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">


                    <div class="bg-slate-50 rounded-xl p-5">

                        <p class="text-sm text-slate-500">
                            Starting Price
                        </p>

                        <p class="text-2xl font-bold text-slate-800 mt-2">

                            £{{ number_format($lot->starting_price, 2) }}

                        </p>

                    </div>


                    <div class="bg-indigo-50 rounded-xl p-5">

                        <p class="text-sm text-indigo-600">
                            Current Bid
                        </p>

                        <p class="text-2xl font-bold text-indigo-700 mt-2">

                            £{{ number_format($lot->current_bid, 2) }}

                        </p>

                    </div>


                    <div class="bg-emerald-50 rounded-xl p-5">

                        <p class="text-sm text-emerald-600">
                            Total Bids
                        </p>

                        <p class="text-2xl font-bold text-emerald-700 mt-2">

                            {{ $lot->bids->count() }}

                        </p>

                    </div>


                </div>



                <!-- Auction -->

                <div class="border-t border-slate-100 pt-6">


                    <p class="text-sm text-slate-500 mb-1">
                        Associated Auction
                    </p>


                    @if($lot->auction)

                        <a
                            href="{{ route('auctions.show', $lot->auction) }}"
                            class="text-lg font-semibold text-indigo-600 hover:underline"
                        >
                            {{ $lot->auction->name }}
                        </a>

                    @else

                        <p class="text-slate-400">
                            No auction assigned
                        </p>

                    @endif


                </div>


            </div>


        </div>



        <!-- Bid History -->

        <div class="bg-white rounded-2xl shadow-sm mt-6 overflow-hidden">


            <div class="p-6 border-b border-slate-100">

                <h2 class="text-xl font-bold text-slate-800">
                    Bid History
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    All bids placed on this lot
                </p>

            </div>


            <div class="overflow-x-auto">


                <table class="w-full text-left">


                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-4">
                                Bidder
                            </th>

                            <th class="px-6 py-4">
                                Email
                            </th>

                            <th class="px-6 py-4">
                                Bid Amount
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y">


                    @forelse($lot->bids->sortByDesc('amount') as $bid)


                        <tr>

                            <td class="px-6 py-4 font-medium">

                                {{ $bid->bidder->name ?? 'Unknown Bidder' }}

                            </td>


                            <td class="px-6 py-4 text-slate-500">

                                {{ $bid->bidder->email ?? '-' }}

                            </td>


                            <td class="px-6 py-4 font-bold text-indigo-600">

                                £{{ number_format($bid->amount, 2) }}

                            </td>


                            <td class="px-6 py-4 text-slate-500">

                                {{ $bid->created_at->format('d M Y, h:i A') }}

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="4" class="px-6 py-12 text-center text-slate-500">

                                No bids have been placed yet.

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>

            </div>


        </div>


    </main>


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



</body>

</html>

