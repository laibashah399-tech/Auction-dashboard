<?php

namespace App\Http\Controllers;

use App\Models\AuctionImage;
use Illuminate\Support\Facades\Storage;

class AuctionImageController extends Controller
{
    public function destroy(AuctionImage $image)
    {
        Storage::disk('public')->delete($image->image);

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}