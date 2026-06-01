<?php

namespace Database\Seeders;

use App\Models\Artwork;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a few specific, realistic examples safely
        Artwork::firstOrCreate(
            ['dams_id' => 'NX-ROCKWELL-01'], // Search for this unique ID
            [ // If it doesn't exist, create it with these details:
                'title' => 'The Runaway',
                'artist' => 'Norman Rockwell',
                'description' => 'A classic illustration depicting a young boy and a police officer at a diner counter.',
                'image_url' => 'https://mock-dams.lucasmuseum.org/assets/NX-ROCKWELL-01/web.jpg',
                'is_published' => true,
            ]
        );

        Artwork::firstOrCreate(
            ['dams_id' => 'NX-KIRBY-99'],
            [
                'title' => 'Fantastic Four Issue #48 Cover Art',
                'artist' => 'Jack Kirby',
                'description' => 'Original pen and ink cover art introducing the Silver Surfer.',
                'image_url' => 'https://mock-dams.lucasmuseum.org/assets/NX-KIRBY-99/web.jpg',
                'is_published' => true,
            ]
        );

        // 2. Generate random mock artworks for pagination testing
        // Note: Running db:seed multiple times will keep adding 15 random ones 
        // because the factory generates unique IDs each time.
        Artwork::factory()->count(15)->create();
    }
}