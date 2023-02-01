<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\AdminsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Models\Department;
use App\Models\Job;

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


/*Route::middleware('auth')->group(function(){
   // Route::get('/admin', 'App\Http\Controllers\AdminsController@index')->name('admin.index');


   

});*/




Route::middleware('role:admin')->group(function(){


    Route::get('admin/users/{user}/profile', 'App\Http\Controllers\UserController@show')->name('user.profile.show');
    Route::put('admin/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('user.profile.update');
    Route::put('admin/users/{user}/attach','App\Http\Controllers\UserController@attach')->name('users.role.attach');

    Route::put('admin/users/{user}/detach','App\Http\Controllers\UserController@detach')->name('users.role.detach');
  
    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');

    Route::get('admin/users/updatepassword/{user}', 'App\Http\Controllers\UserController@indexPassword')->name('users.password.index');
    Route::put('admin/users/{user}/updatepassword', 'App\Http\Controllers\UserController@updatePassword')->name('user.update.password');
  

    Route::delete('admin/users/{user}/destroy', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');


    Route::put('admin/users/{id}/inactivar', 'App\Http\Controllers\UserController@inactivar')->name('user.inactivar');
    Route::put('admin/users/{id}/activar', 'App\Http\Controllers\UserController@activar')->name('user.activar');



    Route::get('admin/users', 'App\Http\Controllers\UserController@index')->name('users.index');


    Route::get('admin/users/new', 'App\Http\Controllers\UserController@create')->name('users.create');



    Route::post('admin/users/new', 'App\Http\Controllers\UserController@new')->name('users.new');

      //ROLES ROUTE
      Route::get('admin/roles', 'App\Http\Controllers\RoleController@index')->name('roles.index');
      Route::post('admin/roles', 'App\Http\Controllers\RoleController@store')->name('roles.store');
      Route::delete('admin/roles/{role}/destroy', 'App\Http\Controllers\RoleController@destroy')->name('role.destroy');
      Route::get('admin/roles/{role}/edit', 'App\Http\Controllers\RoleController@edit')->name('role.edit');
      Route::put('admin/roles/{role}/update', 'App\Http\Controllers\RoleController@update')->name('roles.update');


      Route::put('admin/roles/{role}/attach','App\Http\Controllers\PermissionController@attach')->name('permission.role.attach');

      Route::put('admin/roles/{role}/detach','App\Http\Controllers\PermissionController@detach')->name('permission.role.detach');



      //PERMISSIONS ROUTE
    
       Route::get('admin/permissions', 'App\Http\Controllers\PermissionController@index')->name('permissions.index');
       Route::post('admin/permissions', 'App\Http\Controllers\PermissionController@store')->name('permissions.store');
       Route::delete('admin/permissions/{permission}/destroy', 'App\Http\Controllers\PermissionController@destroy')->name('permissions.destroy');
       Route::get('admin/permissions/{permission}/edit', 'App\Http\Controllers\PermissionController@edit')->name('permissions.edit');
       Route::put('admin/permissions/{permission}/update', 'App\Http\Controllers\PermissionController@update')->name('permissions.update');

    

});

