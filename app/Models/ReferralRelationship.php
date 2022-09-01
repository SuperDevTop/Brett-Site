<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{

    protected $fillable = ['referral_link_id', 'user_email'];

    use HasFactory;
}
