<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\testController;
use App\Http\Controllers\AdminController;
// use App\Http\Controllers\todoController;

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


Route::get('Message/{name}/{id?}',function ($name , $id = null){
    echo 'Student Data name:'.$name.'& id = '.$id;
})->where(['name'=>'[a-zA-Z]+']);
//->where('id','[0-9]+')->where('name','[a-zA-Z]+');


Route::get('Users/{id}',function ($id){
    echo $id;
});



//  Route::get("Message",[testController::class,'message']);


Route::get("Message",'testController@message');
Route::get("UsersDetails",'testController@details');
Route::get('Users/Info',[AdminController::class,'UserInfo']);

# User
Route::get('Users', [AdminController::class, 'index'])->middleware('AdminAuth');
Route::get('Users/Create',[AdminController::class,'create']);
Route::post('Users/Store',[AdminController::class,'store']);
Route::get('Users/edit/{id}', [AdminController::class, 'edit'])->middleware('AdminAuth');
Route::post('Users/update', [AdminController::class, 'update'])->middleware('AdminAuth');
Route::get('Users/remove/{id}', [AdminController::class, 'destroy']);


#Auth ....
Route::get('Login', [AdminController::class, 'Login']);
Route::post('DoLogin', [AdminController::class, 'DoLogin']);
Route::get('logout', [AdminController::class, 'logout'])->middleware('AdminAuth');


Route::resource('todo', todoController::class);   //'todoController'

