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
        if (!$request->has("id")){
            $data['slug']=Str::slug((string)$request->only("title"), '-').time();
            if (!$request->has("url")){
                $data['url']="categories/".$data['slug'];
            }
        }
		return parent::storeRequest($request,$data);
	}

	public function post($slug){
		$products= Category::where('slug',$slug)->first();
		return $products;
	}

}
