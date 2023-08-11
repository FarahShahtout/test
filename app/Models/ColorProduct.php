<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ColorProduct extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'color_product';
    protected $fillable = ['product_id', 'color_id'];

    
}

