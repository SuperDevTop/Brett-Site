<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'store_id',
        'user_id',
        'featured',
        'heading',
        'description',
        'deal_simple_product_status',
        'product_category_id',
        'image',
        'weight',
        'size',
        'quantity',
        'start_date_time',
        'end_date_time',
        'status',
        'regular_price',
        'discount_price',
        'discount_status',
    ];
}