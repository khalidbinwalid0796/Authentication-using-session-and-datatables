<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Javascript\JavascriptController;
use App\Http\Controllers\Jquery\JqueryController;
use App\Http\Controllers\Employee\EmployeeController;
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

Route::get('/', function () {
    return view('welcome');
});

// Custom login and registration system for admin or user(using customers table, custom middleware)
Route::post('/customer/register/save',[MainController::class, 'save'])->name('customer.save');
Route::post('/customer/loginCheck',[MainController::class, 'check'])->name('customer.check');
Route::get('/customer/logout',[MainController::class, 'logout'])->name('customer.logout');

Route::group(['middleware'=>['AuthCheck']], function(){
    Route::get('/customer/login',[MainController::class, 'login'])->name('customer.login');
    Route::get('/customer/register',[MainController::class, 'register'])->name('customer.register');
    Route::get('/customer/dashboard',[MainController::class, 'dashboard']);
});
// End of Custom login and registration system for admin or user

//Ajax with javascript
Route::get('/javascript', [JavascriptController::class, 'index']);
Route::get('/ajax-get', [JavascriptController::class, 'ajax_get'])->name('ajax.get');
Route::post('/ajax-post', [JavascriptController::class, 'ajax_post'])->name('ajax.post');
Route::get('/image', [JavascriptController::class, 'ajax_get_image']);
//End Ajax with javascript

//Ajax with Jquery
Route::group(['prefix' => 'jquery', 'as' => 'jquery.'], function () {
    Route::get('index', [JqueryController::class, 'index']);
    Route::get('ajax-get', [JqueryController::class, 'ajax_get'])->name('ajax.get');
    Route::post('ajax-post', [JqueryController::class, 'ajax_post'])->name('ajax.post');
    Route::get('image', [JqueryController::class, 'ajax_get_image'])->name('ajax.image');
});
//'as' => 'jquery.' --> name route hobe sjquery.ajax.get
//Ajax with Jquery

Route::view('json', 'json');

//Employee
Route::group(['prefix' => 'employee', 'as'=>'employee.'], function () {
    //Ajax route
    Route::post('upazila-list', [EmployeeController::class, 'upazilaList'])->name('upazila.list');
    //end ajax route
    Route::get('home', [EmployeeController::class, 'index'])->name('index');
    Route::post('store', [EmployeeController::class, 'store'])->name('store');
    Route::post('list', [EmployeeController::class, 'userList'])->name('list');
    Route::post('edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::post('update', [EmployeeController::class, 'update'])->name('update');
    Route::post('show', [EmployeeController::class, 'show'])->name('show');
    Route::post('delete', [EmployeeController::class, 'destroy'])->name('delete');
    //Route::post('change-status', [EmployeeController::class, 'changeStatus'])->name('change.status');
    //Route::post('bulk-action-delete', [EmployeeController::class, 'bulkActionDelete'])->name('bulk.action.delete');

});