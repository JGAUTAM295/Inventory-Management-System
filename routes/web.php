<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authentication Routes...
Route::get('/', [
    'as' => 'login',
    'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm'
]);

Route::post('/', [
    'as' => '',
    'uses' => 'App\Http\Controllers\Auth\LoginController@login'
]);

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'App\Http\Controllers\Auth\LoginController@logout'
  ]);
  
  // Password Reset Routes...
  Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail'
  ]);
  Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm'
  ]);
  Route::post('password/reset', [
    'as' => 'password.update',
    'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@reset'
  ]);
  Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm'
  ]);
  
  // Registration Routes...
  Route::get('register', [
    'as' => 'register',
    'uses' => 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm'
  ]);
  Route::post('register', [
    'as' => '',
    'uses' => 'App\Http\Controllers\Auth\RegisterController@register'
  ]);

  Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    //Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        //Route::get('/register', 'RegisterController@show')->name('register.show');
        //Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        //Route::get('/login', 'LoginController@show')->name('login.show');
        //Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth', 'permission']], function() {
        /**
         * User Routes
         */
        Route::group(['prefix' => 'admin/users'], function() {
            Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
            Route::get('/add-users', [App\Http\Controllers\UserController::class, 'create'])->name('addUser');
            Route::post('/store-users', [App\Http\Controllers\UserController::class, 'store'])->name('storeUser');
            Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editUser');
            Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
            //Route::get('/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('viewUser');
            Route::delete('/delete-users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('deleteUser');
            Route::get('/users/clients', [App\Http\Controllers\UserController::class, 'getclients'])->name('clientUser');
            Route::get('/users/staffs', [App\Http\Controllers\UserController::class, 'getstaff'])->name('staffsUser');

        });

        /**
         * Client Routes
         */
        Route::group(['prefix' => 'client'], function() {
            Route::resource('inventory', Backend\InventoryController::class);
            // Route::resource('equipment', Backend\EquipmentController::class);
            Route::get('/inventory/{id}/equipment', 'Backend\EquipmentController@index')->name('equipment.index');
            Route::get('/inventory/{id}/equipment/create', 'Backend\EquipmentController@create')->name('equipment.create');
            Route::post('/inventory/{id}/equipment/create', 'Backend\EquipmentController@store')->name('equipment.store');
            Route::get('/inventory/{id}/equipment/show/{eid}', 'Backend\EquipmentController@show')->name('equipment.show');
            Route::get('/inventory/{id}/equipment/downloadPDF/{eid}','Backend\EquipmentController@downloadPDF')->name('equipment.downloadPDF');
            Route::get('/inventory/{id}/equipment/edit/{eid}', 'Backend\EquipmentController@edit')->name('equipment.edit');
            Route::patch('/inventory/{id}/equipment/update/{eid}', 'Backend\EquipmentController@update')->name('equipment.update');
            Route::delete('/inventory/{id}/equipment/delete/{eid}', 'Backend\EquipmentController@destroy')->name('equipment.destroy');
            Route::get('/inventory/{id}/equipment/qr_code/{eid}', 'Backend\EquipmentController@getQRCode')->name('equipment.getQRCode');
            Route::get('/inventory/{id}/equipment/export', 'Backend\EquipmentController@exportcsv')->name('equipment.export');
            Route::post('/inventory/{id}/equipment/import', 'Backend\EquipmentController@importcsv')->name('equipment.import');

            Route::resource('taxonomy', Backend\TaxonomyController::class);
            Route::resource('taxonomyData', Backend\TaxonomyDataController::class);
            Route::resource('work_order', Backend\WorkOrderController::class);
            
            Route::get('/taxonomy/{id}/data', 'Backend\TaxonomyDataController@index')->name('taxonomyData.index');
            Route::get('/taxonomy/{id}/data/create', 'Backend\TaxonomyDataController@create')->name('taxonomyData.create');
            Route::post('/taxonomy/{id}/data/create', 'Backend\TaxonomyDataController@store')->name('taxonomyData.store');
            Route::get('/taxonomy/{id}/data/show/{tdid}', 'Backend\TaxonomyDataController@show')->name('taxonomyData.show');
            Route::get('/taxonomy/{id}/data/edit/{tdid}', 'Backend\TaxonomyDataController@edit')->name('taxonomyData.edit');
            Route::patch('/taxonomy/{id}/data/update/{tdid}', 'Backend\TaxonomyDataController@update')->name('taxonomyData.update');
            Route::delete('/taxonomy/{id}/data/delete/{tdid}', 'Backend\TaxonomyDataController@destroy')->name('taxonomyData.destroy');

            Route::get('/work_order/report/{id}', 'Backend\ReportController@index')->name('work_order.report');

            // Route::get('/', 'PostsController@index')->name('posts.index');
            // Route::get('/create', 'PostsController@create')->name('posts.create');
            // Route::post('/create', 'PostsController@store')->name('posts.store');
            // Route::get('/{post}/show', 'PostsController@show')->name('posts.show');
            // Route::get('/{post}/edit', 'PostsController@edit')->name('posts.edit');
            // Route::patch('/{post}/update', 'PostsController@update')->name('posts.update');
            // Route::delete('/{post}/delete', 'PostsController@destroy')->name('posts.destroy');
        });

        

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});

  Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/clientStaff/{year}', [App\Http\Controllers\Backend\DashboardController::class, 'clientStaff'])->name('dashboard.clientStaff');
    Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::get('/delete-your-account}', [App\Http\Controllers\UserController::class, 'authRemove'])->name('authRemove');
});