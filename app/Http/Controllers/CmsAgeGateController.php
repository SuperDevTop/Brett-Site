<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\CmsLandingPage;
use App\Models\CmsProductPage;
use App\Models\CmsAgeGate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class CmsAgeGateController extends Controller
{
    public function Index() {
    	$usersData         = $this->GetLoggedInUserData();
    	$customer_all      = CmsProductPage::all();
        $age_gate           = CmsAgeGate::all(); 
        return view("admin/ageGate/index",compact("customer_all","usersData","age_gate"));
    }
    public function GetLoggedInUserData() {
    	return user::find(Auth::user()->id);
    }
    public function EditProcess( Request $request, $age_gate_id) {
	    $update_array = array(
    		"side_text" => $request->side_text,
	    	"header" => $request->header,
	    	"status" => $request->status 
    	);
        $result_status = CmsAgeGate::find($age_gate_id)->update($update_array);
        return Redirect("/admin/age_gate")->with("success", "AgeGate Page Data Updated Successfully");
    }
    public function Edit($age_gate_id) {
    	$usersData = $this->GetLoggedInUserData();
    	if( isset($age_gate_id) && $age_gate_id != "" ) {
	        $age_date_data = CmsAgeGate::find($age_gate_id);
	        return view("admin/ageGate/edit",compact("age_date_data","usersData"));
    	}
    }
}
