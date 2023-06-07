<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'url'           => $faker->imageUrl($width = 640, $height = 480),
            'shortcode'     => substr(hash('sha256', random_bytes(40)), 0, 8),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
