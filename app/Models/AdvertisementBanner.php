<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementBanner extends Model
{
    use HasFactory;
    protected $fillable = [
    	'banner_image',
    	'third_party_code',
    	'location',
    	'lat',
    	'lon',
        'redirect_url',
    	'location_name',
    	'type',
    ];
}