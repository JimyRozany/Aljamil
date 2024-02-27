<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "company_id" => null,
            "category_id" => null,
            "name" => $this->faker->name(),
            "image" => $this->faker->imageUrl(640, 480, 'products'),
            "price" => $this->faker->randomFloat(1000, 200, 1000),
            "description" => $this->faker->text(),
            // "image" => $this->imageUrl(640, 480, 'products', true)
        ];
    }
}
