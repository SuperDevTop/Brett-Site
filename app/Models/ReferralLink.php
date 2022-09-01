<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ReferralLink extends Model
{
    protected $fillable = ['user_id', 'code'];

    public static function getReferral($user)
    {
        return static::firstOrCreate([
            'user_id' => $user->id,
            'code' => $user->id,
        ]);
    }

    public function getLinkAttribute()
    {
        return url('signup') . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relationships()
    {
        return $this->hasMany(ReferralRelationship::class);
    }

}