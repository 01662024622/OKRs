<?php

namespace App\Http\Controllers\HT00;

use App\Http\Controllers\Base\ResouceController;
use App\Models\HT00\CategoryApartment;
use App\Models\HT00\CategoryUser;
use App\Services\HT00\CategoryService;
use Illuminate\Http\Request;
use App\Models\HT00\Category;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request)
    {
        $data = [];
        if (!$request->has("id")) {
            $data['slug'] = Str::slug((string)$request->title, '-') . time();
            $data['sort'] = (int)time();
            if (!$request->has("url")) {
                $data['url'] = "/categories/" . $data['slug'];
            }
        }
        $category = parent::storeRequest($request, $data);

        if ($request->has('users')) {
            $users = $request->users;
            foreach ($users as $user) {
                $arr = explode("_", $user);
                $new_user['user_id'] = (int)$arr[0];
                $new_user['role'] = (int)$arr[1];
                $new_user['category_id'] = (int)$category->id;
                $new_user['create_by'] = Auth::id();
                CategoryUser::create($new_user);
            }
        }
        if ($request->has('apartments')) {
            $apartments = $request->apartments;
            foreach ($apartments as $apartment) {
                $arr = explode("_", $apartment);
                $new_apartment['apartment_id'] = (int)$arr[0];
                $new_apartment['role'] = (int)$arr[1];
                $new_apartment['category_id'] = (int)$category->id;
                $new_apartment['create_by'] = Auth::id();
                CategoryApartment::create($new_apartment);
            }
        }
        if ($request->has('user_update')) {
            $user_update = $request->user_update;
            foreach ($user_update as $user) {
                $arr = explode("_", $user);
                $object_update['role'] = (int)$arr[1];
                $object_update['modify_by'] = Auth::id();
                CategoryUser::find($arr[0])->update($object_update);
            }
        }
        if ($request->has('apartment_update')) {
            $apartment_update = $request->apartment_update;
            foreach ($apartment_update as $apartment) {
                $arr = explode("_", $apartment);
                $apartment_update['role'] = (int)$arr[1];
                $apartment_update['modify_by'] = Auth::id();
                CategoryApartment::find($arr[0])->update($apartment_update);
            }
        }
        return $category;
    }

    public function post($slug)
    {
        $products = Category::where('slug', $slug)->first();
        return $products;
    }

}
