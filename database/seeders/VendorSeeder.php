<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                'vendorName' => 'Bound Tree', 
                'vendorEmail' => 'customercare@boundtree.com,', 
                'vendorPhone' => '(800)533-0523', 
                'vendorURL' => 'https://www.boundtree.com'
            ],
        ];

        DB::table('vendor')->insert($vendors);


    }
}
