<?php

namespace App\Http\Controllers;

use App\Services\NetXSyncService;
use Illuminate\Http\JsonResponse;

class NetXController extends Controller
{
    /**
     * Trigger the NetX DAMS synchronization process.
     */
    public function sync(NetXSyncService $syncService): JsonResponse
    {
        // Call the sync method from the service we built
        $result = $syncService->syncRecentArtworks();

        // Determine the HTTP status code based on success or failure
        $status = $result['status'] === 'success' ? 200 : 500;

        // Return a clean JSON response
        return response()->json($result, $status);
    }
}
