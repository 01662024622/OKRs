<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Http\Controllers\Base\ResouceController;
use App\Model\HT10\Review;
use App\ReviewIprove360;
use App\Services\HT10\ReviewService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ReviewController extends ResouceController
{
    function __construct(ReviewService $service)
    {
        $this->middleware('auth');
        parent::__construct($service, array('active' => 'report_review', 'group' => 'reports'));
        View::share("apartments", Apartment::where("status", 0)->get());
    }


    public function show($id)
    {
        $data = User::where('apartment_id', $id)->where('role', '<>', 'block')->where('status', 0)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data["create_by"]=Auth::id();
        if ($request->hasFile('image')) {
            $name = time()."-".$data['create_by'].".".$request->image->getClientOriginalExtension();
            $request->image->storeAs('/public', $name);
            $data['image']="/public/storage/".$name;
        }
        return parent::storeArr($data);
    }
    public function edit($id, Request  $request){
        if ($request->has("confirm")){
            $data=$request->only("confirm");
            $data['user_status']=-1;
            $review = Review::where("id",$id)->where("user_status",0)->first()->update($data);
            return $review;
        }else{
            $data['user_status']=1;
            $review = Review::where("id",$id)->where("user_status",0)->first()->update($data);
            return $review;
        }
    }
    public function destroy($id)
    {
        return null;
    }




}
