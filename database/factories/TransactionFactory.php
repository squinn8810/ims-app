<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ItemLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{

    public function definition(): array
    {

        $startDate = Carbon::now()->subYears(2);
        $endDate = Carbon::now();

        return [
            'transDate' => fake()->dateTimeBetween($startDate, $endDate),
            'itemLocID' => ItemLocation::all()->random()->itemLocID,
            'employeeID' => User::all()->random()->id,
            'status' => fake()->randomElement(['pending', 'acknowledged', 'ordered']),
        ];
    }
}
