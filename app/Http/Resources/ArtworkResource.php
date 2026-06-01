<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtworkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'artist' => $this->artist,
            'description' => $this->description,
            'assets' => [
                'dams_reference_id' => $this->dams_id,
                'primary_image_url' => $this->image_url,
            ],
            'meta' => [
                'is_published' => (bool) $this->is_published,
                'last_updated' => $this->updated_at->toIso8601String(),
            ]
        ];
    }
}