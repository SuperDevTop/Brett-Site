<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsProductPage extends Model
{
    use HasFactory;
    protected $fillable = [
    'menu',
    'details',
    'deals',
    'review',
    'media'
    ];
}
