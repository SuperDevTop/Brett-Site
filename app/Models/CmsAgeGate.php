<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsAgeGate extends Model
{
    use HasFactory;
    protected $fillable = [ 
    'side_text',
    'header',
    'status', 
    ];
}
