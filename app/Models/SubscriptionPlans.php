<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlans extends Model
{
    use HasFactory;
    protected $fillable = [
	    'user_id',
	    'business_store_id',
		'payment_method',
		'monthy_annual',
		'processing_fee',
		'plan_id',
		'subscription_date',
		'subscription_start_date',
		'subscription_end_date',
		'status_active_deactive',
		'plane_name',
		'price',
		'image',
		'description',
		'plan_options_checkboxes',
		'category_id'
    ];
}