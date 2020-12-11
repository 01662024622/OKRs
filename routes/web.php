<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false,'request' => false, 'reset' => false]);



Route::get('/report/user/{auth}', 'HT10\CustomerController@intergration');
Route::get('/review/user/{auth}', 'HT10\CustomerController@review360');
Route::get('/review/user/success/{auth}', 'HT10\CustomerController@success');

Route::get('/home', 'View\ViewAuthenticationController@home')->name('home');
Route::get('/', 'View\ViewAuthenticationController@home')->name('home');

Route::get('/get-link',
    function (){
        return view("intergration.getlink");
    })->name('getlink');

Route::resource('users', 'HT20\UserController');
Route::resource('apartments', 'HT20\ApartmentController');

Route::get('profile', 'HT20\UserEditController@profile');
Route::get('change-password', 'HT20\UserEditController@password');
Route::post('change-password', 'HT20\UserEditController@changePassword');
Route::post('user-profile', 'HT20\UserEditController@updateProfile');

//Route::resource('report/market', 'HT10\ReportMarketController');
Route::resource('/review/report', 'HT10\ReviewController');
Route::resource('/feedback/report', 'HT10\FeedbackController');
Route::resource('/customer/feedback/report', 'HT10\CustomerFeedbackController');
Route::post('/feedback/PR', 'HT10\FeedbackPRController@store');
Route::post('/feedback/warehouse', 'HT10\FeedbackWareHouseController@store');

Route::get('/customer/feedback/link/{code}', 'HT10\CustomerFeedbackController@indexCode');
//Route::get('/', 'HT10\ReportMarketController@index');
Route::get('/review/feedback', 'HT10\ReviewViewController@feedbackMe');
Route::get('/review/feedback/auth/{auth}', 'Authentication\FeedbackViewController@feedbackMeAuth');
Route::get('/review/feedback/apartment', 'HT10\ReviewViewController@feedbackApartment');
Route::get('/review/feedback/apartment/auth/{auth}', 'Authentication\FeedbackViewController@feedbackApartmentAuth');
Route::get('/review/feedback/manager', 'HT10\ReviewViewController@feedbackManager');
Route::get('/review/feedback/browser', 'HT10\ReviewViewController@feedbackBrowser');
Route::get('/review/feedback/browser/{auth}', 'Authentication\FeedbackViewController@feedbackAuthBrowser');
Route::get('/review/warehouse/report', 'HT10\ReviewViewController@warehouse');
Route::get('/review/warehouse/manager/report', 'HT10\ReviewViewController@warehouseManager');
Route::get('/review/public/relationship/report', 'HT10\ReviewViewController@publicRelationship');
Route::get('/review/public/relationship/manager/report', 'HT10\ReviewViewController@publicRelationshipManager');
Route::get('/review/feedback/customer/report', 'HT10\ReviewViewController@feedbackCustomer');
Route::get('/review/feedback/customer/manager/report', 'HT10\ReviewViewController@feedbackCustomerManager');



Route::resource('categories', 'HT00\CategoryController');

//Route::get('/category/{slug}', 'HomeController@category');
// Route::get('/profile', 'CustomerController@profile');

// Get data Table group
Route::group(['prefix' => 'api/v1'], function() {
	Route::get('category/table', 'DataApi\CategoryApiController@anyData')->name('category.api.data');
	Route::get('users/table', 'DataApi\UserApiController@anyData')->name('users.api.data');
	Route::get('apartments/table', 'DataApi\ApartmentApiController@anyData')->name('apartments.api.data');
	Route::get('report/market/table', 'DataApi\ReportMarketController@anyData')->name('report_market.api.data');
	Route::get('report/review/table', 'DataApi\ReportApiController@reviewData')->name('report_review.api.data');
	Route::get('report/review/feedbackme/table', 'DataApi\ReportApiController@feedbackMeData')->name('report_feedbackme.api.data');
	Route::get('report/review/feedback/apartment/table', 'DataApi\ReportApiController@feedbackApartmentData')->name('report_feedback_apartment.api.data');
	Route::get('report/review/feedback/browser/table', 'DataApi\ReportApiController@feedbackBrowserData')->name('report_feedback_browser.api.data');
	Route::get('report/review/feedback/warehouse/table', 'DataApi\ReportApiController@feedbackWarehouseData')->name('report_feedback_warehouse.api.data');
    Route::get('report/review/feedback/warehouse/manager/table', 'DataApi\ReportApiController@feedbackWarehouseDataManager')->name('report_feedback_warehouse_manager.api.data');
    Route::get('report/review/feedback/public/relationship/table', 'DataApi\ReportApiController@feedbackPRData')->name('report_feedback_pr.api.data');
    Route::get('report/review/feedback/public/relationship/manager/table', 'DataApi\ReportApiController@feedbackPRDataManager')->name('report_feedback_pr_manager.api.data');
    Route::get('report/review/feedback/customer/table', 'DataApi\ReportApiController@feedbackCustomerData')->name('report_feedback_customer.api.data');
    Route::get('report/review/feedback/customer/manager/table', 'DataApi\ReportApiController@feedbackCustomerDataManager')->name('report_feedback_customer_manager.api.data');

});

// Set Status group

Route::group(['prefix' => 'api/status'], function() {
	Route::get('categories/{id}', 'status\StatusController@categories')->name('categories.api.status');
	Route::post('users/{id}', 'DataApi\UserApiController@status')->name('users.api.status');
	Route::post('review/{id}', 'DataApi\ReportApiController@status')->name('review.api.status');

});


