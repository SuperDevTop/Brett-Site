<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalSetting extends Model
{
    use HasFactory;
    protected $fillable = [
	    'project_name',
	    'logo',
	    'phone',
	    'email',
	    'location',
	    'radius',
	    'footer_logo',
	    'discord_link',
	    'reddit_link',
	    'favi_logo',
	    'reviews_show_hide_status',
    ];
}
