<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\CmsLandingPage;
use App\Models\CmsProductPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class CmsProductPageController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$customer_all = CmsProductPage::all();
    	return view("admin/productPage/index",compact("customer_all","usersData"));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    public function EditProcess( Request $request, $customer_id) {
	    $update_array = array(
    		"menu" => $request->menu,
	    	"details" => $request->details,
	    	"deals" => $request->deals,
            "review" => $request->review,
            "media" => $request->media
    	);
        $result_status = CmsProductPage::find($customer_id)->update($update_array);
        return Redirect("/admin/productPage")->with("success", "Landing Page Data Updated Successfully");
    }
    public function Edit($customerId) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($customerId) && $customerId != "" ) {
	        $customer_data = CmsProductPage::find($customerId);
	        return view("admin/productPage/edit",compact("customer_data","usersData"));
    	}
    }
}
