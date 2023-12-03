<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'locName' => 'Oak Hill Station',
                'locAddress' => '275 US Route 1',
                'locCity' => 'Scarborough',
                'locState' => 'Me',
                'locZip' => '04074',
            ],
            [
                'locName' => 'Dunstan Station',
                'locAddress' => '639 Us Route 1',
                'locCity' => 'Scarborough',
                'locState' => 'Me',
                'locZip' => '04074',
            ],
            // Add more location data as needed
        ];

        // Insert the data into the "location" table
        DB::table('location')->insert($locations);

    }
}
