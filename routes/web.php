<?php

use App\Http\Controllers\Admin\{AuthController, ProfileController, UserController};
use GuzzleHttp\Middleware;
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


Route::get('/', function () {
    return view('admin/auth/login');
});

Route::get('/admin/login', [AuthController::class, 'getLogin'])->name('getLogin');
Route::post('/admin/login', [AuthController::class, 'postLogin'])->name('postLogin');

// Route::get('/dashboard', 'ProfileController@dashboard')->name('dashboard');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin',  'middleware' => ['admin_auth']], function () {

    Route::get('dashboard', 'ProfileController@dashboard')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::resource('customers', 'CustomerController');
});

Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');
