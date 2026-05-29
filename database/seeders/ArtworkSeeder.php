<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artwork::create([
            'dams_id' => 'NX-ROCKWELL-01',
            'title' => 'The Runaway',
            'artist' => 'Norman Rockwell',
            'description' => 'A classic illustration depicting a young boy and a police officer at a diner counter.',
            'image_url' => 'https://mock-dams.lucasmuseum.org/assets/NX-ROCKWELL-01/web.jpg',
            'is_published' => true,
        ]);

        Artwork::create([
            'dams_id' => 'NX-KIRBY-99',
            'title' => 'Fantastic Four Issue #48 Cover Art',
            'artist' => 'Jack Kirby',
            'description' => 'Original pen and ink cover art introducing the Silver Surfer.',
            'image_url' => 'https://mock-dams.lucasmuseum.org/assets/NX-KIRBY-99/web.jpg',
            'is_published' => true,
        ]);

        Artwork::factory()->count(15)->create();
    }
}
