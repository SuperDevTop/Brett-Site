<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
class TransactionsController extends Controller
{
    public function Index() {
    	$usersData = $this->GetLoggedInUserData();
    	$transactions_all = DB::select('SELECT users.first_name,users.last_name, name, subscription_plans.* FROM subscription_plans
    	 INNER JOIN categories ON subscription_plans.category_id = categories.id 
    	 INNER JOIN users ON subscription_plans.user_id = users.id 
    	 ORDER BY id DESC ');
    	return view("admin/transactions/index",compact("transactions_all","usersData"));
    }
    public function GetLoggedInUserData() {
    	return user::find( Auth::user()->id );
    }
    public function transactionView($transactin_id) {
    	$usersData = $this->GetLoggedInUserData();
    	$transactions_all = DB::select('SELECT users.first_name,users.id as user_id,users.last_name, name, subscription_plans.* FROM subscription_plans
    	 INNER JOIN categories ON subscription_plans.category_id = categories.id 
    	 INNER JOIN users ON subscription_plans.user_id = users.id 
    	 WHERE subscription_plans.id = "'.$transactin_id.'"
    	 ORDER BY id DESC ');
    	if( isset($transactions_all) && count($transactions_all) > 0 ) {
    		$transactions_all = $transactions_all[0];
    	}
    	return view("admin/transactions/view",compact("transactions_all","usersData"));
    }
}
