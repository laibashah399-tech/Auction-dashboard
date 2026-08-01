<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auction;
use App\Models\Lot;
use App\Models\Bidder;
use App\Models\Bid;
use App\Models\Payment;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;

class AuctionDashboardSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | BIDDERS
            |--------------------------------------------------------------------------
            */

            $bidders = [];

            for ($i = 1; $i <= 10; $i++) {
                $bidders[] = Bidder::create([
                    'name' => "Test Bidder {$i}",
                    'email' => "bidder{$i}@example.com",
                    'phone' => "+92 300 00000{$i}",
                    'address' => "Islamabad, Pakistan",
                    'is_active' => true,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | SELLERS
            |--------------------------------------------------------------------------
            */

            for ($i = 1; $i <= 5; $i++) {
                Seller::create([
                    'name' => "Test Seller {$i}",
                    'email' => "seller{$i}@example.com",
                    'phone' => "+92 301 00000{$i}",
                    'address' => "Islamabad, Pakistan",
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | AUCTIONS
            |--------------------------------------------------------------------------
            */

            // LIVE AUCTION
            $liveAuction = Auction::create([
                'name' => 'Spring Art & Antiques Auction',
                'description' => 'Live auction for testing the dashboard.',
                'status' => 'live',
                'start_at' => now()->subHours(2),
                'end_at' => now()->addDays(2),
                'total_sales' => 0,
            ]);


            // UPCOMING AUCTION
            $upcomingAuction = Auction::create([
                'name' => 'Upcoming Luxury Collection',
                'description' => 'Upcoming auction with luxury items.',
                'status' => 'upcoming',
                'start_at' => now()->addDays(5),
                'end_at' => now()->addDays(7),
                'total_sales' => 0,
            ]);


            // COMPLETED AUCTION
            $completedAuction = Auction::create([
                'name' => 'Classic Collectibles Auction',
                'description' => 'Completed auction for dashboard testing.',
                'status' => 'completed',
                'start_at' => now()->subDays(10),
                'end_at' => now()->subDays(5),
                'total_sales' => 125000,
            ]);


            // DRAFT AUCTION
            $draftAuction = Auction::create([
                'name' => 'Draft Estate Auction',
                'description' => 'Draft auction for testing.',
                'status' => 'draft',
                'start_at' => null,
                'end_at' => null,
                'total_sales' => 0,
            ]);


            /*
            |--------------------------------------------------------------------------
            | LOTS
            |--------------------------------------------------------------------------
            */

            // LIVE AUCTION LOTS
            $liveLot1 = Lot::create([
                'auction_id' => $liveAuction->id,
                'lot_number' => 'LOT-1001',
                'title' => 'Antique Persian Carpet',
                'description' => 'Beautiful antique Persian carpet.',
                'starting_price' => 1000,
                'current_bid' => 2500,
                'status' => 'available',
                'image' => 'lots/persian-carpet.jpg',
            ]);

            $liveLot2 = Lot::create([
                'auction_id' => $liveAuction->id,
                'lot_number' => 'LOT-1002',
                'title' => 'Vintage Gold Watch',
                'description' => 'Vintage luxury gold watch.',
                'starting_price' => 2000,
                'current_bid' => 4500,
                'status' => 'available',
                'image' => 'lots/gold-watch.jpg',
            ]);

            $liveLot3 = Lot::create([
                'auction_id' => $liveAuction->id,
                'lot_number' => 'LOT-1003',
                'title' => 'Modern Art Painting',
                'description' => 'Original modern art painting.',
                'starting_price' => 5000,
                'current_bid' => 8500,
                'status' => 'available',
                'image' => null,
            ]);


            // UPCOMING AUCTION LOTS
            Lot::create([
                'auction_id' => $upcomingAuction->id,
                'lot_number' => 'LOT-2001',
                'title' => 'Luxury Diamond Necklace',
                'description' => 'Elegant diamond necklace.',
                'starting_price' => 10000,
                'current_bid' => 0,
                'status' => 'available',
                'image' => 'lots/diamond-necklace.jpg',
            ]);

            Lot::create([
                'auction_id' => $upcomingAuction->id,
                'lot_number' => 'LOT-2002',
                'title' => 'Rare Antique Vase',
                'description' => 'Rare antique decorative vase.',
                'starting_price' => 3000,
                'current_bid' => 0,
                'status' => 'available',
                'image' => null,
            ]);


            // COMPLETED AUCTION LOTS
            $soldLot1 = Lot::create([
                'auction_id' => $completedAuction->id,
                'lot_number' => 'LOT-3001',
                'title' => 'Antique Painting',
                'description' => 'Classic antique painting.',
                'starting_price' => 5000,
                'current_bid' => 25000,
                'status' => 'sold',
                'image' => 'lots/antique-painting.jpg',
            ]);

            $soldLot2 = Lot::create([
                'auction_id' => $completedAuction->id,
                'lot_number' => 'LOT-3002',
                'title' => 'Vintage Sculpture',
                'description' => 'Vintage collectible sculpture.',
                'starting_price' => 3000,
                'current_bid' => 15000,
                'status' => 'sold',
                'image' => 'lots/sculpture.jpg',
            ]);

            $unsoldLot = Lot::create([
                'auction_id' => $completedAuction->id,
                'lot_number' => 'LOT-3003',
                'title' => 'Old Wooden Cabinet',
                'description' => 'Antique wooden cabinet.',
                'starting_price' => 2000,
                'current_bid' => 0,
                'status' => 'unsold',
                'image' => null,
            ]);


            /*
            |--------------------------------------------------------------------------
            | BIDS
            |--------------------------------------------------------------------------
            */

            // Bids for live lot 1
            Bid::create([
                'lot_id' => $liveLot1->id,
                'bidder_id' => $bidders[0]->id,
                'amount' => 1500,
            ]);

            Bid::create([
                'lot_id' => $liveLot1->id,
                'bidder_id' => $bidders[1]->id,
                'amount' => 2000,
            ]);

            Bid::create([
                'lot_id' => $liveLot1->id,
                'bidder_id' => $bidders[2]->id,
                'amount' => 2500,
            ]);


            // Bids for live lot 2
            Bid::create([
                'lot_id' => $liveLot2->id,
                'bidder_id' => $bidders[3]->id,
                'amount' => 3000,
            ]);

            Bid::create([
                'lot_id' => $liveLot2->id,
                'bidder_id' => $bidders[4]->id,
                'amount' => 4500,
            ]);


            // Bids for sold lot 1
            Bid::create([
                'lot_id' => $soldLot1->id,
                'bidder_id' => $bidders[5]->id,
                'amount' => 15000,
            ]);

            Bid::create([
                'lot_id' => $soldLot1->id,
                'bidder_id' => $bidders[6]->id,
                'amount' => 25000,
            ]);


            // Bids for sold lot 2
            Bid::create([
                'lot_id' => $soldLot2->id,
                'bidder_id' => $bidders[7]->id,
                'amount' => 15000,
            ]);


            /*
            |--------------------------------------------------------------------------
            | PAYMENTS
            |--------------------------------------------------------------------------
            */

            // PAID PAYMENT
            Payment::create([
                'bidder_id' => $bidders[6]->id,
                'lot_id' => $soldLot1->id,
                'amount' => 25000,
                'status' => 'paid',
                'payment_method' => 'Bank Transfer',
            ]);


            // PENDING PAYMENT
            Payment::create([
                'bidder_id' => $bidders[7]->id,
                'lot_id' => $soldLot2->id,
                'amount' => 15000,
                'status' => 'pending',
                'payment_method' => 'Credit Card',
            ]);


            // FAILED PAYMENT
            Payment::create([
                'bidder_id' => $bidders[5]->id,
                'lot_id' => $soldLot1->id,
                'amount' => 15000,
                'status' => 'failed',
                'payment_method' => 'Online Payment',
            ]);
        });
    }
}
