<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodSettings extends Model
{
    use HasFactory;
    protected $fillable = [
	    'method_name',
	    'method_key',
	    'method_secret',
	    'method_redirect_url',
	    'fee_measurement',
	    'processing_fee',
	    'status',
    ];
}
