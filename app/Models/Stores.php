<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;
    protected $fillable = [
    	"bussiness_user_id",
		"name",
		"address",
		"store_location",
		"email",
		"logo",
		"description",
		"link_to_website_listing_page",
		"phone",
		"store_amenity",
		"category",
		
		"seo_title",
		"seo_description",
		"seo_keyword",
		"seo_image",

		"link_with_social_media",
		"store_hours",
		"status",
		"lat",
		"long",
		"delivery_service_info",
		"about_us_info",
		"description",
		"company_name_status",
		"show_address_status",
		"company_logo_status",
		"store_location_name",
		"business_descripotion_status",
		"marker_status",
		"premium_marker_status",
		"link_to_website_status",
		"link_to_social_media_status",
		"store_hours_status",
		"reviews_on_listing_status",
		"create_view_deals_status",
		"phone_number_status",
		"import_photos_status",
		"import_videos_status",
		"delivery_Service_description_status",
		"about_us_information_status",
		"subscription_active"
    ];

    public function business_user_data() {
        return $this->hasOne(User::class, 'id','bussiness_user_id');
    }
}