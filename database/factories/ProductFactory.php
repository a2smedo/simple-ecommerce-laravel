<?php

namespace Database\Factories;

use App\Models\Product;
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
            'name' => json_encode([
                'en' => $this->faker->word(),
                'ar' => $this->faker->word(),
            ]),
            'desc' => json_encode([
                'en' => $this->faker->text(500),
                'ar' => $this->faker->text(500),
            ]),
            'img' => "products/1.png",
            'price' => $this->faker->numberBetween(1000, 10000),
            'quantity' => $this->faker->numberBetween(10, 200),
            'reviews' => 1,
            'rating' => 1,
            'discount' => $this->faker->numberBetween(10, 30),
            'active' => 1,
        ];
    }
}
