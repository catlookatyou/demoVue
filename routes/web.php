<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\PostController;
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

Route::get('/{any?}', function () {
    //return view('welcome');
    return view('demo');
});
