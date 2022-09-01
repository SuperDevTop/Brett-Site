<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreMedia extends Model
{
    use HasFactory;
    protected $fillable = [
	    'store_id',
	    'media_name',
    ];
}
