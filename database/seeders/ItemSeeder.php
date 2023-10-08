<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            [
                'itemNum' => '1',
                'itemName' => 'Adult Nasal Cannula',
                'itemURL' => 'https://www.boundtree.com',
                'vendorName' => 'Bound Tree',
                'vendorID' => 1,
            ],
            [
                'itemNum' => '2',
                'itemName' => 'SpO2 Sensor PEDI',
                'itemURL' => 'https://www.boundtree.com',
                'vendorName' => 'Bound Tree',
                'vendorID' => 1,
            ],
            // Add more items as needed
        ];

        // Insert the data into the "item" table
        DB::table('item')->insert($items);

    }
}
