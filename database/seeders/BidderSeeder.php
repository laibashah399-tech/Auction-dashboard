<?php

namespace Database\Seeders;

use App\Models\Bidder;
use Illuminate\Database\Seeder;

class BidderSeeder extends Seeder
{
    public function run(): void
    {
        $bidders = [
            [
                'bidder_number' => 'BD-2045',
                'name' => 'James Anderson',
                'email' => 'james@example.com',
                'phone' => '+44 7700 900101',
                'address' => 'London, UK',
                'status' => 'active',
                'total_bids' => 18,
                'total_spent' => 12500,
            ],
            [
                'bidder_number' => 'BD-2046',
                'name' => 'Sophia Williams',
                'email' => 'sophia@example.com',
                'phone' => '+44 7700 900102',
                'address' => 'Manchester, UK',
                'status' => 'active',
                'total_bids' => 25,
                'total_spent' => 18750,
            ],
            [
                'bidder_number' => 'BD-2047',
                'name' => 'Oliver Brown',
                'email' => 'oliver@example.com',
                'phone' => '+44 7700 900103',
                'address' => 'Birmingham, UK',
                'status' => 'active',
                'total_bids' => 12,
                'total_spent' => 8200,
            ],
            [
                'bidder_number' => 'BD-2048',
                'name' => 'Emma Taylor',
                'email' => 'emma@example.com',
                'phone' => '+44 7700 900104',
                'address' => 'Liverpool, UK',
                'status' => 'inactive',
                'total_bids' => 7,
                'total_spent' => 4500,
            ],
            [
                'bidder_number' => 'BD-2049',
                'name' => 'Noah Wilson',
                'email' => 'noah@example.com',
                'phone' => '+44 7700 900105',
                'address' => 'Leeds, UK',
                'status' => 'active',
                'total_bids' => 31,
                'total_spent' => 24500,
            ],
            [
                'bidder_number' => 'BD-2050',
                'name' => 'Mia Johnson',
                'email' => 'mia@example.com',
                'phone' => '+44 7700 900106',
                'address' => 'Bristol, UK',
                'status' => 'active',
                'total_bids' => 15,
                'total_spent' => 9800,
            ],
        ];

        foreach ($bidders as $bidder) {
            Bidder::create($bidder);
        }
    }
}