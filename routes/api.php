<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;

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
    //Route::post('password/reset', ResetPasswordController::class);
Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::get('user_roles', 'API\AuthController@getUserRole')->name('UserRole');
    Route::post('login', 'API\AuthController@login')->name('login');
    Route::post('register', 'API\AuthController@register')->name('register');
    Route::post('password/email', 'API\AuthController@forgotPassword')->name('forgotPassword');
    Route::post('password/code/check', 'API\AuthController@codecheck')->name('codecheck');

    // After Login Routes
    Route::middleware('auth:sanctum')->group(function ()
    {
        Route::resource('work_order', Backend\WorkOrderController::class);
        Route::get('work_order_list', 'API\StaffController@workOrderList')->name('workOrderList');
        Route::post('create_work_order', 'API\StaffController@create_work_order')->name('workOrderCreate');
        Route::get('equipment_issues', 'API\EquipmentIssueController@equipment_issues')->name('equipmentIssuesList');
        Route::get('get_equipments', 'API\EquipmentIssueController@get_equipments')->name('getEquipments');
        Route::get('get_staff', 'API\EquipmentIssueController@get_staff')->name('getStaff');
        Route::get('get_customers', 'API\EquipmentIssueController@get_customers')->name('getCustomers');
        Route::get('get_departments', 'API\EquipmentIssueController@get_departments')->name('getDepartments');
        Route::post('create_equipment_issues', 'API\EquipmentIssueController@create_equipment_issues')->name('equipmentIssuesCreate');
        Route::post('update_workorder', 'Backend\WorkOrderController@update_workorder')->name('update_workorder');
        Route::get('profile', 'API\StaffController@profile')->name('profile');
        Route::post('change_password', 'API\StaffController@changePassword')->name('changePassword');
        Route::get('notifications', 'API\NotificationController@index')->name('notifications');
        Route::get('notification/{id}', 'API\NotificationController@readnotification')->name('readnotification');
        Route::get('clear_notification_id/{id}', 'API\NotificationController@deletenotification')->name('deletenotification');
        Route::get('clear_notifications', 'API\NotificationController@destroyallnotification')->name('destroyallnotification');
        Route::post('logout', 'API\AuthController@logout')->name('logout');
    });

});