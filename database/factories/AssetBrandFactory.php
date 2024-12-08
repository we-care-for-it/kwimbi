<?php

namespace Database\Factories;

use App\Models\AssetBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssetBrand>
 */
class AssetBrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
