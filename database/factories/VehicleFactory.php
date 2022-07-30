<?php

namespace Database\Factories;

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        return [
            'brand' => $faker->vehicleBrand,
            'model' => $faker->vehicleModel,
            'plate_number' => $faker->vehicleRegistration,
            'insurance_date' => Carbon::today()->subDays(rand(0, 365))
        ];
    }
}
