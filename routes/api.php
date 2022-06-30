<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::get('user_roles', 'API\AuthController@getUserRole')->name('UserRole');
    Route::post('login', 'API\AuthController@login')->name('login');
    Route::post('register', 'API\AuthController@register')->name('register');
    Route::post('password/email', 'API\AuthController@forgotPassword')->name('forgotPassword');

    Route::middleware('auth:sanctum')->group(function ()
    {
        Route::resource('work_order', Backend\WorkOrderController::class);
        Route::get('work_order_list', 'API\StaffController@workOrderList')->name('workOrderList');
        Route::post('update_workorder', 'Backend\WorkOrderController@update_workorder')->name('update_workorder');
        Route::get('profile', 'API\StaffController@profile')->name('profile');
        Route::post('change_password', 'API\StaffController@changePassword')->name('changePassword');
        Route::post('logout', 'API\AuthController@logout')->name('logout');
    });

});