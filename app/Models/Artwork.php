<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory; // <-- This fixes your factory() error

    /**
     * The attributes that are mass assignable.
     * <-- This prevents the Mass Assignment error when running the seeder
     */
    protected $fillable = [
        'dams_id',
        'title',
        'artist',
        'description',
        'image_url',
        'is_published',
    ];
}
