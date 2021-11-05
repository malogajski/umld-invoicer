<?php

namespace Database\Factories\Codebooks;

use App\Models\Codebooks\Associate;
use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class AssociateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Associate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_id' => City::inRandomOrder()->limit(1)->first(),
            'country_id' => Country::inRandomOrder()->limit(1)->first(),
            'name' => $this->faker->company(),
            'pib' => $this->faker->numberBetween(1000000, 9999999),
            'registration_number' => $this->faker->numberBetween(1000000, 9999999),
            'address' => $this->faker->address(),
            'responsible_person' => $this->faker->firstName() . ' ' . $this->faker->lastName()
        ];
    }
}
