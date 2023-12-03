<?php

namespace Database\Seeders;

use App\Models\ItemLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemLocations = [
            [
                'itemNum' => '1',
                'itemReorderQty' => 20,
                'locID' => 1,
            ],
            [
                'itemNum' => '2',
                'itemReorderQty' => 10,
                'locID' => 1,
            ],
            // Add more item location data as needed
        ];

        // Insert the data into the "item" table
        DB::table('item_location')->insert($itemLocations);
    }
}
