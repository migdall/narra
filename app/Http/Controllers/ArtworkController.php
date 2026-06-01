<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Http\Resources\ArtworkResource;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the published artworks.
     */
    public function index()
    {
        // Only return published artworks, and paginate them for mobile performance
        $artworks = Artwork::where('is_published', true)
            ->latest()
            ->paginate(10);

        return ArtworkResource::collection($artworks);
    }

    /**
     * Display the specified artwork.
     */
    public function show(Artwork $artwork)
    {
        // Ensure unpublished artworks aren't leaked via direct ID lookup
        if (!$artwork->is_published) {
            abort(404, 'Artwork not found or not published.');
        }

        return new ArtworkResource($artwork);
    }
}