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

Route::middleware('guest')->group(function () {
    Route::get('/login', 'Auth\AuthController@loginShow')->name('login');
    Route::post('login', 'Auth\AuthController@login')->name('login');
});

Route::middleware(['user_auth'])->group(function () {

    Route::get('/', 'TaskController@create')->name('dashboard');
    Route::get('/logout', 'Auth\AuthController@logout')->name('logout');


    // Route::prefix('admin')->group(function () {

    //     Route::get('/dashboard', 'TaskController@create')->name('admin.dashboard');
    // });

    Route::resource('tasks', 'TaskController');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('login', function () {
        return view('pages.auth.login');
    });
    Route::get('register', function () {
        return view('pages.auth.register');
    });
});

Route::group(['prefix' => 'error'], function () {
    Route::get('404', function () {
        return view('pages.error.404');
    });
    Route::get('500', function () {
        return view('pages.error.500');
    });
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}', function () {
    return View::make('pages.error.404');
})->where('page', '.*');
