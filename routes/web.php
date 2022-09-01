<?php
use Illuminate\Support\Facades\Route;
// ADMINISTRATOR ROUTES STARTS HERE
	use App\Http\Controllers\LoginAuth;
	use App\Http\Controllers\CustomersController;
	use App\Http\Controllers\BusinessController;
	use App\Http\Controllers\AdminEmployeeController;
	use App\Http\Controllers\AdminProfileController;
	use App\Http\Controllers\CategoryController;
	use App\Http\Controllers\PlansController;
	use App\Http\Controllers\StoreController;
	use App\Http\Controllers\CmsLandingPageController;
	use App\Http\Controllers\CmsProductPageController;
	use App\Http\Controllers\CmsAgeGateController;
	use App\Http\Controllers\AjaxControllerWeb;
	use App\Http\Controllers\AdminAdvertisementBanners;
	use App\Http\Controllers\PortalSetting;
	use App\Http\Controllers\AmenitiesController;
	use App\Http\Controllers\ProductsCategoryController;
	use App\Http\Controllers\AdminProductsController;
	use App\Http\Controllers\PaymentMethodSettingsController;
	use App\Http\Controllers\TransactionsController;
	use App\Http\Controllers\LocationBannerAdv;
	use App\Http\Controllers\ClaimStoresController;
	use App\Http\Controllers\CmsfooterPageController;
	use App\Http\Controllers\MailController1;
	
	Route::group(['middleware' => ['CheckAdminLoggedIn']], function () {
		Route::get('/admin/', [LoginAuth::class, 'index']);
		Route::post('/admin/login', [LoginAuth::class, 'LoginProcess'])->name("admin_login_process");
	});
	Route::group(['middleware' => ['Administrator']], function () {
			Route::get('/admin/dashboard', [LoginAuth::class, 'AdminDashboard'])->name("admin_dashboard");
			Route::get('/admin/contactRequest', [LoginAuth::class, 'AllContactRequests'])->name("contact_request");

			Route::get('/admin/claimListing', [ClaimStoresController::class, 'claimStore'])->name("claim_listing");

			Route::get('/admin/logout', [LoginAuth::class, 'SignOutProcess'])->name("admin_logout");
		// ADMIN CUSTOMERS ROUTING STARTS
			Route::get('/admin/customer', [CustomersController::class, 'Index'])->name("customer_listing");
			Route::get('/admin/customer/add', [CustomersController::class, 'Add'])->name("admin_customer_add");
			Route::post('/admin/addCustomerProcess', [CustomersController::class, 'AddProcess'])->name("admin_customer_add_process");
			Route::get('/admin/customer/view/{id}', [CustomersController::class, 'View']);
			Route::get('/admin/customer/edit/{id}', [CustomersController::class, 'Edit']);
			Route::post('/admin/EditCustomerProcess/{id}', [CustomersController::class, 'EditProcess']);
			Route::get('/admin/customer/delete/{id}', [CustomersController::class, 'DeleteProcess']);
		// ADMIN CUSTOMERS ROUTING ENDS
		// ADMIN BUSINESS ROUTING STARTS
			Route::get('/admin/business', [BusinessController::class, 'Index'])->name("business_listing");
			Route::get('/admin/business/add', [BusinessController::class, 'Add'])->name("admin_business_add");
			Route::post('/admin/addBusinessProcess', [BusinessController::class, 'AddProcess'])->name("admin_business_add_process");
			Route::get('/admin/business/view/{id}', [BusinessController::class, 'View']);
			Route::get('/admin/business/edit/{id}', [BusinessController::class, 'Edit']);
			Route::post('/admin/EditBusinessProcess/{id}', [BusinessController::class, 'EditProcess']);
			Route::get('/admin/business/delete/{id}', [BusinessController::class, 'DeleteProcess']);
		// ADMIN BUSINESS ROUTING ENDS
		
		// ADMIN BUSINESS ROUTING STARTS
			Route::get('/admin/admin_employee', [AdminEmployeeController::class, 'Index'])->name("admin_employee_listing");
			Route::get('/admin/admin_employee/add', [AdminEmployeeController::class, 'Add'])->name("admin_admin_employee_add");
			Route::post('/admin/addadmin_employeeProcess', [AdminEmployeeController::class, 'AddProcess'])->name("admin_admin_employee_add_process");
			Route::get('/admin/admin_employee/view/{id}', [AdminEmployeeController::class, 'View']);
			Route::get('/admin/admin_employee/edit/{id}', [AdminEmployeeController::class, 'Edit']);
			Route::post('/admin/Editadmin_employeeProcess/{id}', [AdminEmployeeController::class, 'EditProcess']);
			Route::get('/admin/admin_employee/delete/{id}', [AdminEmployeeController::class, 'DeleteProcess']);
		// ADMIN BUSINESS ROUTING ENDS

		// ADMIN PROFILE ROUTING STARTS
			Route::get('/admin/adminProfile/view/', [AdminProfileController::class, 'View']);
			Route::get('/admin/adminProfile/edit/', [AdminProfileController::class, 'Edit']);
			Route::post('/admin/EditAdminProfileProcess/{id}', [AdminProfileController::class, 'EditProcess']);
		// ADMIN BUSINESS ROUTING ENDS
		// CATEGORIES ROUTING STARTS
			Route::get('/admin/categories', [CategoryController::class, 'Index'])->name("categories_listing");
			Route::get('/admin/categories/add', [CategoryController::class, 'Add'])->name("admin_categories_add");
			Route::post('/admin/addCategoriesProcess', [CategoryController::class, 'AddProcess'])->name("admin_categories_add_process");
			Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'Edit']);
			Route::post('/admin/EditCategoriesProcess/{id}', [CategoryController::class, 'EditProcess']);
			Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'DeleteProcess']);
		// CATEGORIES ROUTING ENDS
		// AMENITIES STARTS
			Route::get('/admin/amenities', [AmenitiesController::class, 'Index'])->name("amenities_listing");
			Route::get('/admin/amenities/add', [AmenitiesController::class, 'Add'])->name("admin_amenities_add");
			Route::post('/admin/addAmenitiesProcess', [AmenitiesController::class, 'AddProcess'])->name("admin_amenities_add_process");
			Route::get('/admin/amenities/edit/{id}', [AmenitiesController::class, 'Edit']);
			Route::post('/admin/EditAmenitiesProcess/{id}', [AmenitiesController::class, 'EditProcess']);
			Route::get('/admin/amenities/delete/{id}', [AmenitiesController::class, 'DeleteProcess']);
		// AMENITIES ENDS

		// LOCATION BANNERS STARTS
			Route::get('/admin/location_banners', [LocationBannerAdv::class, 'Index'])->name("location_banner_listing");
			Route::get('/admin/location_banners/add', [LocationBannerAdv::class, 'Add'])->name("admin_location_banner_add");
			Route::post('/admin/addLocation_bannersProcess', [LocationBannerAdv::class, 'AddProcess'])->name("admin_location_banner_add_process");
			Route::get('/admin/location_banners/edit/{id}', [LocationBannerAdv::class, 'Edit']);
			Route::post('/admin/Editlocation_bannerProcess/{id}', [LocationBannerAdv::class, 'EditProcess']);
			Route::get('/admin/location_banners/delete/{id}', [LocationBannerAdv::class, 'DeleteProcess']);
		// LOCATION BANNERS ENDS

		// PRODUCTS CATEGORY STARTS
			Route::get('/admin/productsCategory', [ProductsCategoryController::class, 'Index'])->name("productsCategory_listing");
			Route::get('/admin/productsCategory/add', [ProductsCategoryController::class, 'Add'])->name("admin_productsCategory_add");
			Route::post('/admin/addproductsCategoryProcess', [ProductsCategoryController::class, 'AddProcess'])->name("admin_productsCategory_add_process");
			Route::get('/admin/productsCategory/edit/{id}', [ProductsCategoryController::class, 'Edit']);
			Route::post('/admin/EditproductsCategoryProcess/{id}', [ProductsCategoryController::class, 'EditProcess']);
			Route::get('/admin/productsCategory/delete/{id}', [ProductsCategoryController::class, 'DeleteProcess']);
		// PRODUCTS CATEGORY ENDS
		// ADMIN PRODUCTS STARTS
			Route::get('/admin/products', [AdminProductsController::class, 'Index'])->name("products_listing");
			Route::get('/admin/products/add', [AdminProductsController::class, 'Add'])->name("admin_products_add");
			Route::post('/admin/addproductsProcess', [AdminProductsController::class, 'AddProcess'])->name("admin_products_add_process");
			Route::get('/admin/products/edit/{id}', [AdminProductsController::class, 'Edit']);
			Route::post('/admin/EditproductsProcess/{id}', [AdminProductsController::class, 'EditProcess']);
			Route::get('/admin/products/delete/{id}', [AdminProductsController::class, 'DeleteProcess']);
		// ADMIN PRODUCTS ENDS
		// ADMIN ADVERT BANNERS STARTS
			Route::get('/admin/banners', [AdminAdvertisementBanners::class, 'Index'])->name("admin_advertiements");
			Route::get('/admin/banners/add', [AdminAdvertisementBanners::class, 'Add'])->name("admin_banners_add");
			Route::post('/admin/addBannersProcess', [AdminAdvertisementBanners::class, 'AddProcess'])->name("admin_banner_add_process");
			Route::get('/admin/banners/edit/{id}', [AdminAdvertisementBanners::class, 'Edit']);
			Route::post('/admin/EditBannersProcess/{id}', [AdminAdvertisementBanners::class, 'EditProcess']);	
			Route::get('/admin/banners/delete/{id}', [AdminAdvertisementBanners::class, 'DeleteProcess']);
		// ADMIN ADVERT BANNERS ENDS

		// PORTAL SETTING STARTS
			Route::get('/admin/portalSettings', [PortalSetting::class, 'Edit']);
			Route::post('/admin/EditPortalProfileProcess/{id}', [PortalSetting::class, 'EditProcess']);
		// PORTAL SETTING ENDS

		// PLANS ROUTING STARTS
			Route::get('/admin/plans', [PlansController::class, 'Index'])->name("plans_listing");
			Route::get('/admin/plans/add', [PlansController::class, 'Add'])->name("admin_plans_add");
			Route::get('/admin/plans/view/{id}', [PlansController::class, 'View']);
			Route::post('/admin/addPlansProcess', [PlansController::class, 'AddProcess'])->name("admin_plans_add_process");
			Route::get('/admin/plans/edit/{id}', [PlansController::class, 'Edit']);
			Route::post('/admin/EditPlansProcess/{id}', [PlansController::class, 'EditProcess']);
			Route::get('/admin/plans/delete/{id}', [PlansController::class, 'DeleteProcess']);
		// PLANS ROUTING ENDS

		// PLANS ROUTING STARTS
			Route::get('/admin/stores', [StoreController::class, 'Index'])->name("stores_listing");
			Route::get('/admin/stores/add', [StoreController::class, 'Add'])->name("admin_stores_add");
			Route::get('/admin/stores/view/{id}', [StoreController::class, 'View']);
			Route::post('/admin/addStoresProcess', [StoreController::class, 'AddProcess'])->name("admin_stores_add_process");
			Route::get('/admin/stores/edit/{id}', [StoreController::class, 'Edit']);
			Route::post('/admin/EditStoresProcess/{id}', [StoreController::class, 'EditProcess']);
			Route::get('/admin/stores/delete/{id}', [StoreController::class, 'DeleteProcess']);
		// PLANS ROUTING ENDS

		// CMS LANDING PAGE STARTS
			Route::get('/admin/landingPage', [CmsLandingPageController::class, 'Index'])->name("landingPage_listing");
			Route::get('/admin/landingPage/edit/{id}', [CmsLandingPageController::class, 'Edit']);
			Route::post('/admin/EditLandingPageProcess/{id}', [CmsLandingPageController::class, 'EditProcess']);
		// CMS LANDING PAGE ENDS

		// CMS Product PAGE STARTS
			Route::get('/admin/productPage', [CmsProductPageController::class, 'Index'])->name("landingPage_listing");
			Route::get('/admin/productPage/edit/{id}', [CmsProductPageController::class, 'Edit']);
			Route::post('/admin/EditProductPageProcess/{id}', [CmsProductPageController::class, 'EditProcess']);

		// CMS age_gate PAGE STARTS
			Route::get('/admin/age_gate', [CmsAgeGateController::class, 'Index'])->name("landingPage_listing");
			Route::get('/admin/age_gate/edit/{id}', [CmsAgeGateController::class, 'Edit']);
			Route::post('/admin/EditAgeGateProcess/{id}', [CmsAgeGateController::class, 'EditProcess']);
		// CMS age_gate PAGE ENDS

		// CMS FOOTER PAGE STARTS
			Route::get('/admin/footerPage', [CmsfooterPageController::class, 'Edit']);
			Route::get('/admin/footerPageDelete/{id}', [CmsfooterPageController::class, 'footerPageDelete']);
			Route::post('/admin/footerPageParentAdd', [CmsfooterPageController::class, 'footerPageParentAdd']);
			Route::post('/admin/footerPageParentEdit/{id}', [CmsfooterPageController::class, 'footerPageParentEdit']);
			Route::get('/admin/footerPageEditParent/{id}', [CmsfooterPageController::class, 'EditParent']);
			Route::post('/admin/EditfooterPageProcess', [CmsfooterPageController::class, 'EditProcess']);

			Route::post('/admin/footerPageChildAdd', [CmsfooterPageController::class, 'footerPageChildAdd']);
			Route::get('/admin/footerPageEditChild/{id}', [CmsfooterPageController::class, 'EditChild']);
			Route::post('/admin/footerPageChildEdit/{id}', [CmsfooterPageController::class, 'footerPageChildEdit']);

		// CMS FOOTER PAGE ENDS

		// CMS Product PAGE STARTS
			Route::get('/admin/paymentSettings', [PaymentMethodSettingsController::class, 'Edit']);
			Route::post('/admin/EditpaymentSettingsProcess/{id}', [PaymentMethodSettingsController::class, 'EditProcess']);
		// CMS Product PAGE ENDS

		// CMS Product PAGE STARTS
			Route::get('/admin/transactions/', [TransactionsController::class, 'index']);
			Route::get('/admin/transactions/view/{id}', [TransactionsController::class, 'transactionView']);
		// CMS Product PAGE ENDS

		Route::get('/admin/planCatDetails/', [PlansController::class, 'planCatDetails'])->name("planCatDetails");
		Route::post('/admin/planCatDetailsUpdateProcess', [PlansController::class, 'planCatDetailsUpdateProcess']);

	});
	// Route::get('/admin/register', [LoginAuth::class, 'RegisterProcess']);
// ADMINISTRATOR ROUTES STARTS ENDS

// WEBSITE ROUTES STARTS
	use App\Http\Controllers\CustomerAuth;
	use App\Http\Controllers\web\CustomerBusinessAuth;
	use App\Http\Controllers\web\Home;
	use App\Http\Controllers\web\Deliveries;
	use App\Http\Controllers\web\DeliveryDetails;
	use App\Http\Controllers\web\Doctors;
	use App\Http\Controllers\web\DoctorsDetails;
	use App\Http\Controllers\web\BusinessProfile;
	use App\Http\Controllers\web\StoreProfile;
	use App\Http\Controllers\web\ProductsProfile;
	use App\Http\Controllers\web\StoreFollowing;
	use App\Http\Controllers\web\StoreReviews;
	use App\Http\Controllers\web\StoreReferrals;
	use App\Http\Controllers\web\ProductsController;
	use App\Http\Controllers\web\DispensaryController;
	use App\Http\Controllers\web\DispensaryDetails;
	use App\Http\Controllers\web\StorePlansController;
	use App\Http\Controllers\web\BuyPlans;
	use App\Http\Controllers\web\DealsController;
	use App\Http\Controllers\web\DealsProfileController;

	Route::get('/', [Home::class, 'indexv2']);
	Route::get('/home/', [Home::class, 'indexv2']);
	// Route::get('/homev2/', [Home::class, 'indexv2']);
	Route::get('/signup', [CustomerBusinessAuth::class, 'signup'])->name("signup");
	Route::post('/signupProcess', [CustomerBusinessAuth::class, 'signupProcess'])->name("signup_process");
	Route::post('/doctordetailssignup', [CustomerBusinessAuth::class, 'doctordetailssignup'])->name("doctordetailssignup");
	
	Route::get('/verifyEmailAddress/{id}', [CustomerBusinessAuth::class, 'verifyEmailAddress'])->name("verifyEmailAddress");

	Route::post('/changeSignUpVerification', [CustomerBusinessAuth::class, 'changeSignUpVerification'])->name("changeSignUpVerification");

	Route::get('/resendSignUpVerification/{id}', [CustomerBusinessAuth::class, 'resendSignUpVerification']);

	Route::get('/emailVerificationCode/{id}', [CustomerBusinessAuth::class, 'emailVerificationCode'])->name("emailVerificationCode");
	
	

	Route::get('/login', [CustomerBusinessAuth::class, 'login'])->name("login");
	Route::post('/doctordetailslogin', [CustomerBusinessAuth::class, 'doctordetailslogin'])->name("doctordetailslogin");
	Route::post('/loginProcess', [CustomerBusinessAuth::class, 'loginProcess'])->name("login_process");
	
	Route::get('/logout', [CustomerBusinessAuth::class, 'SignOutProcess'])->name("logout");
	Route::post('/ajax_age_verification', [AjaxControllerWeb::class, 'age_verification'])->name("ajax_age_verification");

	Route::post('/change_claim_status/', [AjaxControllerWeb::class, 'change_claim_status'])->name("change_claim_status");
	Route::post('/change_user_status/', [AjaxControllerWeb::class, 'change_user_status'])->name("change_user_status");
	
	Route::get('/deliveries', [Deliveries::class, 'index']);
	Route::get('/deliveryDetails/{id}', [DeliveryDetails::class, 'index']);
	Route::get('/doctors', [Doctors::class, 'index']);
	Route::get('/doctorDetails/{id}', [DoctorsDetails::class, 'index']);
	Route::get('/dispensaries', [DispensaryController::class, 'index']);
	Route::get('/search-filters/{id}', [DispensaryController::class, 'search_filters']);
	Route::get('/search-filters/', [DispensaryController::class, 'search_filters']);
	
	//Route::group(['middleware' => ['CheckBusinessUserLoggedIn']], function () {
		Route::get('/businessProfile/', [BusinessProfile::class, 'index']);
		Route::get('/businessProfile/{user_type}', [BusinessProfile::class, 'user_type_selection']);
		Route::post('/EditBusinessProfileProcess', [BusinessProfile::class, 'EditProcess']);
		Route::get('/storeProfile/', [StoreProfile::class, 'index']);
		Route::post('/EditStoreProfileProcess', [StoreProfile::class, 'EditProcess']);
		Route::get('/products/', [ProductsProfile::class, 'index']);
		
		Route::get('/productsEdit/{id}', [ProductsProfile::class, 'productEdit']);
		Route::post('/EditProductProcess', [ProductsProfile::class, 'EditProcess']);

		Route::get('/storeDeals/', [DealsProfileController::class, 'index']);
		Route::post('/AddProductsProcess', [ProductsProfile::class, 'AddProcess']);
		Route::post('/AddDealsProcess', [DealsProfileController::class, 'AddProcess']);
		Route::get('storeFollowing', [StoreFollowing::class, 'index']);
		Route::get('storeReviews', [StoreReviews::class, 'index']);
		Route::get('storeReferrals', [StoreReferrals::class, 'index']);
		
		Route::post('RatingSubmitStoreProcess', [StoreReviews::class, 'SubmitStoreRating']);
		Route::post('/follow_store_web/{id}', [AjaxControllerWeb::class, 'follow_store_web'])->name("follow_store_web");
		Route::get('/subscription/thankyou/', [BuyPlans::class, 'thankyou'])->name("thankyou");
		Route::get('/subscription/error/', [BuyPlans::class, 'error'])->name("error");
		Route::post('/subscription_cancel_process', [BuyPlans::class, 'subscription_cancel_process'])->name("subscription_cancel_process");
		Route::get('/subscription_canceled', [BuyPlans::class, 'subscription_canceled'])->name("subscription_canceled");
		Route::post('/mark_featured_un_featured_product', [AjaxControllerWeb::class, 'mark_featured_un_featured_product'])->name("mark_featured_un_featured_product");
	//});
	Route::get('/buyPlan/{id}', [BuyPlans::class, 'index'])->name("buyPlan");
	Route::post('/buyPlanProcess/', [BuyPlans::class, 'buyPlanProcess'])->name("buyPlanProcess");

	Route::get('/storePlans/', [StorePlansController::class, 'index']);
	Route::get('/storePlans/{id}', [StorePlansController::class, 'showAllCategoryPlans']);
	Route::get('/singleProductDetails/{id}', [ProductsProfile::class, 'singleProductDetails']);
	Route::get('/singleProductDelete/{id}', [ProductsProfile::class, 'singleProductDelete']);
	Route::get('/singleDealDetails/{id}', [ProductsProfile::class, 'singleDealDetails']);
	Route::post('/product_filteration_data/{id}', [AjaxControllerWeb::class, 'productFilterationData'])->name("product_filteration_data");
	Route::post('/deal_filteration_data/', [AjaxControllerWeb::class, 'productFilterationData'])->name("deal_filteration_data");
	Route::get('/allProducts/', [ProductsController::class, 'index']);
	Route::get('/allProducts/{id}', [ProductsController::class, 'allCategoryProducts']);
	// Route::get('/dispensaries', [DispensaryController::class, 'index']);
	Route::get('/dispensaries/{id}', [DispensaryController::class, 'index']);
	Route::get('/dispensaryDetails/{id}', [DispensaryDetails::class, 'index']);
	Route::post('/get_dispesary_details', [AjaxControllerWeb::class, 'get_dispesary_details'])->name("get_dispesary_details");
	Route::post('/get_dispesary_with_maps', [AjaxControllerWeb::class, 'get_dispesary_with_maps'])->name("get_dispesary_with_maps");
	Route::post('/get_dispesary_with_grid', [AjaxControllerWeb::class, 'get_dispesary_with_grid'])->name("get_dispesary_with_grid");
	Route::get('/allDeals/', [DealsController::class, 'index']);
	Route::get('/favourite/', [DealsController::class, 'favourites'])->name("favourites");
	Route::get('/searchProducts/{id}', [ProductsController::class, 'searchProducts']);
	Route::get('/allDeals/{id}', [DealsController::class, 'allCategoryProducts']);
	Route::get('/storeLocation/{id}', [StoreProfile::class, 'storeByLocationName']);

	Route::post('/get_store_suggestions', [AjaxControllerWeb::class, 'get_store_suggestions'])->name("get_store_suggestions");
	Route::post('/mark_fav_unfav', [AjaxControllerWeb::class, 'mark_fav_unfav'])->name("mark_fav_unfav");

// WEBSITE ROUTES ENDS
use App\Http\Controllers\web\StripeController;
Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');

use App\Http\Controllers\web\FacebookSocialiteController;
Route::get('auth/facebook', [FacebookSocialiteController::class, 'redirectToFB']);
Route::get('callback/facebook', [FacebookSocialiteController::class, 'handleCallback']);

use App\Http\Controllers\web\GoogleController;
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

use App\Http\Controllers\web\ClaimGoogleController;
Route::get('auth/claim/google', [ClaimGoogleController::class, 'redirectToGoogle']);
Route::get('auth/claim/google/callback', [ClaimGoogleController::class, 'handleGoogleCallback']);

use App\Http\Controllers\web\ClaimFacebookController;
Route::get('auth/claim/facebook', [ClaimFacebookController::class, 'redirectToFB']);
Route::get('callback/facebook', [ClaimFacebookController::class, 'handleCallback']);


use App\Http\Controllers\web\RedditDiscord;
Route::get('discordAuthenticate', [RedditDiscord::class, 'discordAuthenticate']);
Route::get('discord', [RedditDiscord::class, 'discordAuthenticate']);

Route::get('redditAuthenticate', [RedditDiscord::class, 'redditAuthenticate']);
Route::get('reddit', [RedditDiscord::class, 'reddit']);

Route::get('/storesGrid/', [StoreProfile::class, 'storeGridView']);
Route::get('/contactUs/', [Home::class, 'contactUs']);


Route::get('/claim_store_listing/', [Home::class, 'claim_store_listing']);

Route::get('/featuredProducts/', [ProductsController::class, 'featuredProducts']);
Route::get('/featuredDeals/', [ProductsController::class, 'featuredDeals']);


use App\Http\Controllers\web\mailController;
Route::post("send-email", [mailController::class, 'sendEmail'])->name("send-email");

use App\Http\Controllers\web\emailController;
Route::get('email', [emailController::class, 'index']);
Route::post("send-mail",[emailController::class, 'sendMail'])->name("send-mail");

use App\Http\Controllers\web\NotificationController;
Route::post("claim-store", [NotificationController::class, "claimStore"])->name("claimStore");

use App\Http\Controllers\SendMailController;
Route::get('mail',[SendMailController::class, 'sendEmail']);

// use App\Http\Controllers\web\ShareSocialController;
// Route::get('/share-social', [ShareSocialController::class,'shareSocial']);
Route::group(['prefix' => 'v1'], function(){
  Route::get('sendmail', [MailController1::class, 'sendEmail']);
});
