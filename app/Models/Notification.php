<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
    	'store_id',
    	'name',
    	'email',
    	'phone',
    	'message'
    ];
}
