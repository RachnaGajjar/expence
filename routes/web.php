<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('/transaction', 'TransactionResourceController');

    Route::get('user/profile', function () {
        // Uses first & second Middleware
    });

    Route::get('/report/{year?}/{month?}/{date?}', 'ReportController@index')->middleware(['report-date'])->name('report');

});

Route::any('/webhook/{extra?}', function() {
	return response()->json(request());
});