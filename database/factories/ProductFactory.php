<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'sku'=>fake()->name(),
             'stock'=>fake()->randomNumber(),
             'unit'=>fake()->word(),
             'weight'=>fake()->randomNumber(5),
             'price'=>fake()->randomNumber(6),
             'is_active'=>fake()->boolean(),
             
            
        ];
    }
}