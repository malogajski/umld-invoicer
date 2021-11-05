<?php

namespace Database\Factories\Codebooks;

use App\Models\Codebooks\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->realTextBetween(100, 200),
            'sku' => $this->faker->numberBetween(1000000, 9999999),
            'barcode' => $this->faker->numberBetween(1000000, 9999999),
            'price' => $this->faker->numberBetween(10,10000),
            'tax' => 0
        ];
    }
}
