<?php

namespace App\Http\Controllers\HT00;

use App\Http\Controllers\Base\ResouceController;
use App\Services\HT00\CategoryService;
use Illuminate\Http\Request;
use App\Models\HT00\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class CategoryController extends ResouceController
{
    function __construct(CategoryService $service)
    {
        $this->middleware('auth');
        parent::__construct($service, array('active' => 'category', 'group' => 'configuration'));
        View::share('categories', $service->all());
    }

	public function store(Request $request) {
        if ($request->has("id") && $request->id!="") {
            $data=$request->only(['id', 'name', 'parent_id']);
        }else{
            $data=$request->only(['name', 'parent_id']);
        }
		$data['slug']=Str::slug($data['name'], '-').time();
		return parent::storeRequest($request,$data);
	}

	public function post($slug){
		$products= Category::where('slug',$slug)->first();
		return $products;
	}

}
