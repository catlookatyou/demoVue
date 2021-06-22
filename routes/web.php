<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

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

Route::post('/adminLogin', [AuthController::class, 'login'])->name('login');
Route::post('/adminLogout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    //return Auth::user();
    return new UserResource(Auth::user());  //Auth::guard('web or sanctum')
});
Route::middleware('auth:web')->get('/testauth2', function (Request $request){
    return Auth::user();
});
Route::middleware('auth:api')->get('/testauth3', function (Request $request){
    return Auth::user();
});

Route::get('/{any?}', function () {
    //return view('welcome');
    return view('demo');
});
