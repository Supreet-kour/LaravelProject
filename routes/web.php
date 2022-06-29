<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserDetailsController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\UserContactController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AdminAgentController;

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
Route::middleware(['auth'])->group(function(){
Route::get('/', function () {
    return view('auth.login');
});
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
Route::get('logout',[App\Http\Controllers\HomeController::class, 'logout']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Contact Form
Route::get('/contact',[ContactController::class,'contact'])->name('contact');
Route::post('/contact-us',[ContactController::class,'addData']);

//Admin
Route::middleware(['auth','isAdmin'])->group(function(){
Route::get('admin/dashboard',[AdminController::class,'index']);
Route::get('admin/client',[ClientController::class,'index']);
Route::get('admin/edit-detail/{client_id}',[ClientController::class,'edit']);
Route::put('admin/update-details/{client_id}',[ClientController::class,'update']);
Route::get('admin/delete-detail/{client_id}',[ClientController::class,'delete']);
Route::get('admin/users',[UserDetailsController::class,'index']);
Route::get('admin/edit-user/{user_id}',[UserDetailsController::class,'edit']);
Route::put('admin/update-user/{user_id}',[UserDetailsController::class,'update']);
Route::get('admin/add-user',[UserDetailsController::class,'add']);
Route::post('admin/add-user-details',[UserDetailsController::class,'store']);
Route::get('change-password',[ChangePasswordController::class,'index']);
Route::post('update-password',[ChangePasswordController::class,'update']);
Route::get('admin/permission',[PermissionController::class,'index']);
Route::get('admin/permission-add',[PermissionController::class,'add']);
Route::post('admin/permission-add-details',[PermissionController::class,'store']);
Route::get('admin/agent/dashboard',[AdminAgentController::class,'index']);
Route::get('admin/agent/client',[AdminAgentController::class,'details']);
Route::get('admin/agent/edit-detail/{client_id}',[AdminAgentController::class,'edit']);
Route::put('admin/agent/update-details/{client_id}',[AdminAgentController::class,'update']);
Route::get('admin/agent/delete-detail/{client_id}',[AdminAgentController::class,'delete']);
});


//user
Route::middleware(['auth'])->group(function(){
Route::get('user/dashboard',[UserController::class,'index']);
Route::get('change-password',[ChangePasswordController::class,'index']);
Route::post('update-password',[ChangePasswordController::class,'update']);
Route::get('contact-form',[UserContactController::class,'index']);
Route::get('edit-detail/{client_id}',[UserContactController::class,'edit']);
Route::put('update-details/{client_id}',[UserContactController::class,'update']);
Route::get('delete-detail/{client_id}',[UserContactController::class,'delete']);

});

//Agent
Route::middleware(['auth'])->group(function(){
Route::get('agent/dashboard',[AgentController::class,'index']);
Route::get('agent/client',[AgentController::class,'details']);
Route::get('agent/edit-detail/{client_id}',[AgentController::class,'edit']);
Route::put('agent/update-details/{client_id}',[AgentController::class,'update']);
Route::get('agent/delete-detail/{client_id}',[AgentController::class,'delete']);
Route::get('agent/users',[AgentController::class,'view']);
Route::get('agent/edit-user/{user_id}',[AgentController::class,'useredit']);
Route::put('agent/update-user/{user_id}',[AgentController::class,'userupdate']);
Route::get('agent/add-user',[AgentController::class,'useradd']);
Route::post('agent/add-user-details',[AgentController::class,'userstore']);
Route::get('change-password',[ChangePasswordController::class,'index']);
Route::post('update-password',[ChangePasswordController::class,'update']);
});
