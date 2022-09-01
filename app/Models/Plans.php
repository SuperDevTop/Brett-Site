<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    use HasFactory;
    protected $fillable = [
    	'plane_name',
    	'price',
    	'image',
    	'description',
    	'plan_options_checkboxes',
        'plan_options_checkboxes_value',
    	'feature_listing_rotation',
    	'products_shoe_of_category',
    	'category_id',
    	'status'
    ];

    public function categoryData() {
        return $this->hasOne(Categories::class, 'id','category_id');
    }

}