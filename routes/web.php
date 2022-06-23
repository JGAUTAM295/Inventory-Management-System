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
            Route::get('/inventory/{id}/equipment/edit/{eid}', 'Backend\EquipmentController@edit')->name('equipment.edit');
            Route::patch('/inventory/{id}/equipment/update/{eid}', 'Backend\EquipmentController@update')->name('equipment.update');
            Route::delete('/inventory/{id}/equipment/delete/{eid}', 'Backend\EquipmentController@destroy')->name('equipment.destroy');

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
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);

    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    
   
    
    // Route::get('/roles', [PermissionController::class,'Permission']);

    // Route::get('/users/role', [App\Http\Controllers\Backend\RoleController::class, 'index'])->name('usersRole');
    // Route::get('/users/role/add', [App\Http\Controllers\Backend\RoleController::class, 'create'])->name('addUserRole');
    // Route::post('/users/role/store', [App\Http\Controllers\Backend\RoleController::class, 'store'])->name('storeUserRole');
    // Route::get('/users/role/edit/{id}', [App\Http\Controllers\Backend\RoleController::class, 'edit'])->name('editUserRole');
    // Route::post('/users/role/update/{id}', [App\Http\Controllers\Backend\RoleController::class, 'update'])->name('updateUserRole');
    // Route::delete('/users/role/delete/{id}', [App\Http\Controllers\Backend\RoleController::class, 'destroy'])->name('deleteUserRole');

    
    // Route::get('/projects', [App\Http\Controllers\Backend\ProjectController::class, 'index'])->name('projects');
    // Route::get('/add-projects', [App\Http\Controllers\Backend\ProjectController::class, 'create'])->name('addProject');
    // Route::post('/store-projects', [App\Http\Controllers\Backend\ProjectController::class, 'store'])->name('storeProject');
    // Route::get('/projects/edit/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'edit'])->name('editProject');
    // Route::post('/projects/update/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'update'])->name('updateProject');
    // Route::get('/projects/{slug}', [App\Http\Controllers\Backend\ProjectController::class, 'show'])->name('viewProject');
    // Route::delete('/delete-projects/{id}', [App\Http\Controllers\Backend\ProjectController::class, 'destroy'])->name('deleteProject');

    // Route::get('/projects/{id}/task', [App\Http\Controllers\Backend\TaskController::class, 'index'])->name('tasks');
    // Route::get('/projects/{id}/task/add', [App\Http\Controllers\Backend\TaskController::class, 'create'])->name('addTask');
    // Route::post('/projects/task/store', [App\Http\Controllers\Backend\TaskController::class, 'store'])->name('storeTask');
    // Route::get('/projects/task/edit/{id}', [App\Http\Controllers\Backend\TaskController::class, 'edit'])->name('editTask');
    // Route::post('/projects/task/update/{id}', [App\Http\Controllers\Backend\TaskController::class, 'update'])->name('updateTask');
    // Route::get('/projects/{projectid}/task/{id}', [App\Http\Controllers\Backend\TaskController::class, 'show'])->name('viewTask');
    // Route::delete('/projects/task/delete/{id}', [App\Http\Controllers\Backend\TaskController::class, 'destroy'])->name('deleteTask');
    
    // Route::get('/tags', [App\Http\Controllers\Backend\TagController::class, 'index'])->name('tags');
    // Route::get('/add-tags', [App\Http\Controllers\Backend\TagController::class, 'create'])->name('addTag');
    // Route::post('/store-tags', [App\Http\Controllers\Backend\TagController::class, 'store'])->name('storeTag');
    // Route::post('/tags/edit', [App\Http\Controllers\Backend\TagController::class, 'edit'])->name('editTag');
    // Route::post('/tags/update', [App\Http\Controllers\Backend\TagController::class, 'update'])->name('updateTag');
    // Route::get('/tags/{slug}', [App\Http\Controllers\Backend\TagController::class, 'show'])->name('viewTag');
    // Route::delete('/delete-tags/{id}', [App\Http\Controllers\Backend\TagController::class, 'destroy'])->name('deleteTag');
    
    // Route::post('/store-review', [App\Http\Controllers\Backend\ReviewController::class, 'store'])->name('storeReview');
});