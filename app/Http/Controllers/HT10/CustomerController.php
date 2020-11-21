<?php

namespace App\Http\Controllers\HT10;

use App\Http\Controllers\Controller;
use App\Model\HT20\Apartment;
use App\Model\HT20\B20Customer;
use App\Model\HT20\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function intergration($auth)
    {
        //check Authorization header
        $user = User::where('authentication', "=", $auth)->where("role","<>","blocker")->where("status","0")->first();
        if (Auth::check()) {
            Auth::logout();
        }
        if ($user) {
            Auth::login($user);
            return view('report_market.intergration', ['auth' => $auth, 'name' => $user['name'], 'customers' => Customer::all()]);
        }
        return view("errors.404");

    }

    public function review360($auth)
    {
        //check Authorization header
        $user = User::where('authentication', "=", $auth)->where("role","<>","blocker")->where("status","0")->first();
        if (Auth::check()) {
            Auth::logout();
        }
        if ($user){
            Auth::login($user);
            return view('report_review.feedback', ['apartment' => $user->apartment->name, "apartments" => Apartment::where("status", 0)->get(),'active' => 'create_review360','group'=>'reports']);
        }
        return view("errors.404");
    }

    public function success($auth)
    {
        //check Authorization header
        return view('report_review.success', ['auth' => $auth]);
    }


}
