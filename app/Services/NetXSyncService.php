<?php

namespace App\Services;

use App\Models\Artwork;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NetXSyncService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        // In a real application, these values are securely stored in your .env file
        $this->baseUrl = config('services.netx.url');
        $this->apiKey = config('services.netx.key');
    }

    /**
     * Fetch recently updated assets from the DAMS and sync them locally.
     */
    public function syncRecentArtworks(): array
    {
        Log::info('Starting NetX DAMS synchronization...');

        try {
            // Simulate the API call to NetX
            // In a live environment, this would look like: 
            // $response = Http::withToken($this->apiKey)->get("{$this->baseUrl}/assets/recent");
            // $assets = $response->json();
            
            $assets = $this->mockNetXApiResponse();
            $syncedCount = 0;

            foreach ($assets as $asset) {
                $this->updateOrCreateArtwork($asset);
                $syncedCount++;
            }

            Log::info("NetX Sync complete. Synced {$syncedCount} assets.");

            return [
                'status' => 'success',
                'message' => "Successfully synced {$syncedCount} artworks from NetX.",
            ];

        } catch (\Exception $e) {
            Log::error('NetX Sync failed: ' . $e->getMessage());

            return [
                'status' => 'error',
                'message' => 'Failed to synchronize with NetX DAMS.',
            ];
        }
    }

    /**
     * Map the DAMS payload to our local Artwork model.
     */
    protected function updateOrCreateArtwork(array $asset): void
    {
        // updateOrCreate prevents duplicate entries during syncs
        Artwork::updateOrCreate(
            // 1. The unique identifier we are checking against
            ['netx_asset_id' => $asset['id']], 
            
            // 2. The data we want to update (or insert if it's new)
            [
                'title' => $asset['name'],
                'artist' => $asset['creator'],
                'description' => $asset['description'],
                'image_url' => $asset['file_url'],
            ]
        );
    }

    /**
     * Mock data to simulate the NetX API response for portfolio purposes.
     */
    private function mockNetXApiResponse(): array
    {
        return [
            [
                'id' => 'NX-1001',
                'name' => 'Concept Art: Star Wars Trench Run',
                'creator' => 'Ralph McQuarrie',
                'description' => 'Early concept visualization for the Death Star trench run.',
                'file_url' => 'https://sandbox.local/storage/netx/nx-1001.jpg',
            ],
            [
                'id' => 'NX-1002',
                'name' => 'The Problem We All Live With',
                'creator' => 'Norman Rockwell',
                'description' => 'Iconic civil rights era illustration.',
                'file_url' => 'https://sandbox.local/storage/netx/nx-1002.jpg',
            ]
        ];
    }
}
