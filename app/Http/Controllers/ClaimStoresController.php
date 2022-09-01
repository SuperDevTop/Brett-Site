<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\DB;


class ClaimStoresController extends Controller
{
     public function claimStore() {
      $usersData = user::find(Auth::user()->id);
      $contact_requests = DB::select('select * FROM notifications ORDER BY id');
      $complete_data = array();
      if( count($contact_requests) > 0 ) {
      		foreach ($contact_requests as $key => $each_Store) {
      			$store_data = DB::select('select * FROM stores WHERE id = "'.$each_Store->store_id.'" ORDER BY id');
      			if( count($store_data) > 0 ) {
	      			$complete_data[$key]['claim_data'] = $each_Store;
	      			$complete_data[$key]['store_data'] = $store_data[0];
	      		}
      		}
      }
      return view("admin/claimStores/index", compact("usersData","complete_data"));
    }
}
