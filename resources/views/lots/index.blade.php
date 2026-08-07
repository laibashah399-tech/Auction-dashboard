@extends('layouts.app')

@section('title', 'Lots')

@section('page-heading', 'Lots')

@section('page-description', 'Manage all auction lots.')

@section('content')

<div class="space-y-6">


    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                All Lots
            </h1>

            <p class="text-slate-500 mt-1">
                Manage your auction lots, prices and images.
            </p>

        </div>


        <a
            href="{{ route('lots.create') }}"
            class="inline-flex items-center justify-center px-5 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700"
        >
            + Create Lot
        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
            {{ session('success') }}
        </div>

    @endif


    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50 border-b">

                    <tr>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Image
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Lot
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Auction
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Starting Price
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Current Bid
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Bids
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right text-sm font-semibold">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y">

                    @forelse($lots as $lot)

                        <tr class="hover:bg-slate-50">


                            {{-- Image --}}
                         

<td class="px-6 py-4">

    @if($lot->image)

        <div class="flex items-center gap-3">

            

            <!-- Image Path -->
            <button
                type="button"
                onclick="showLotImage('{{ asset('storage/' . $lot->image) }}')"
                class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline font-mono"
            >
                {{ $lot->image }}
            </button>

        </div>

    @else

        <span class="text-sm text-gray-400">
            No image
        </span>

    @endif

</td>





                            {{-- Lot --}}
                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('lots.show', $lot) }}"
                                    class="font-semibold text-indigo-600 hover:underline"
                                >
                                    {{ $lot->lot_number }}
                                </a>

                                <p class="text-sm text-slate-500">
                                    {{ $lot->title }}
                                </p>

                            </td>


                            {{-- Auction --}}
                            <td class="px-6 py-4 text-sm">

                                {{ $lot->auction->name ?? 'No Auction' }}

                            </td>


                            {{-- Starting --}}
                            <td class="px-6 py-4 font-semibold">

                                £{{ number_format($lot->starting_price, 2) }}

                            </td>


                            {{-- Current --}}
                            <td class="px-6 py-4 font-bold text-indigo-600">

                                £{{ number_format($lot->current_bid, 2) }}

                            </td>


                            {{-- Bids --}}
                            <td class="px-6 py-4">

                                {{ $lot->bids_count }}

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($lot->status === 'available')

                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        Available
                                    </span>

                                @elseif($lot->status === 'sold')

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        Sold
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        Unsold
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">


                                    {{-- View --}}
                                    <a
                                        href="{{ route('lots.show', $lot) }}"
                                        class="px-3 py-2 bg-slate-100 rounded-lg hover:bg-slate-200 text-sm"
                                    >
                                        View
                                    </a>


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('lots.edit', $lot) }}"
                                        class="px-3 py-2 bg-indigo-100 text-indigo-700 rounded-lg hover:bg-indigo-200 text-sm"
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
                                            class="px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-slate-400">

                                    <p class="text-lg font-semibold">
                                        No lots found
                                    </p>

                                    <p class="text-sm mt-1">
                                        Create your first lot to get started.
                                    </p>

                                    <a
                                        href="{{ route('lots.create') }}"
                                        class="inline-block mt-4 px-5 py-2.5 bg-indigo-600 text-white rounded-lg"
                                    >
                                        Create Lot
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

            <div class="p-5 border-t">

                {{ $lots->links() }}

            </div>

        @endif

    </div>

</div>

<!-- LOT IMAGE MODAL -->

<div
    id="lotImageModal"
    class="fixed inset-0 z-9999 hidden items-center justify-center bg-black/80 p-5"
>

    <div class="relative max-w-5xl max-h-[90vh]">

        <!-- Close -->
        <button
            type="button"
            onclick="hideLotImage()"
            class="absolute -top-4 -right-4 w-10 h-10 rounded-full bg-white text-black text-2xl font-bold shadow-lg hover:bg-gray-200"
        >
            ×
        </button>

        <!-- Image -->
        <img
            id="lotModalImage"
            src=""
            alt="Lot Image"
            class="max-w-[90vw] max-h-[85vh] object-contain rounded-xl"
        >

    </div>

</div>


<script>

function showLotImage(imageUrl)
{
    const modal = document.getElementById('lotImageModal');
    const image = document.getElementById('lotModalImage');

    image.src = imageUrl;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.body.style.overflow = 'hidden';
}


function hideLotImage()
{
    const modal = document.getElementById('lotImageModal');
    const image = document.getElementById('lotModalImage');

    modal.classList.remove('flex');
    modal.classList.add('hidden');

    image.src = '';

    document.body.style.overflow = '';
}


/* Close by clicking outside image */

document.getElementById('lotImageModal').addEventListener('click', function(event)
{
    if (event.target === this)
    {
        hideLotImage();
    }
});


/* Close with ESC */

document.addEventListener('keydown', function(event)
{
    if (event.key === 'Escape')
    {
        hideLotImage();
    }
});

</script>

@endsection
