<?php

namespace Database\Factories;

use App\Models\Artwork;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Simulating a NetX UUID or string ID
            'dams_id' => $this->faker->unique()->regexify('[A-Z0-9]{10}'), 
            'title' => $this->faker->words(3, true),
            'artist' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            // Simulating a CDN url from the DAMS
            'image_url' => 'https://cdn.lucasmuseum.org/mock/' . $this->faker->uuid() . '.jpg',
            'is_published' => $this->faker->boolean(80), // 80% chance of being published
        ];
    }
}
