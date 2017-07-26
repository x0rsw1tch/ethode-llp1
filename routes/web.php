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
    return view('home');
});

Route::get('/new-idea', 'IdeasController@create');
Route::get('/ideas', 'IdeasController@index');
Route::post('/ideas', 'IdeasController@store');


Route::get('/status', function () {
    return view('status');
});

Route::get('/status/dbaccess', function () {
    $dbAccess = DB::connection()->getName();
    if ($dbAccess) {
    	return $dbAccess;
    } else {
    	return abort(500);
    }
});

Route::get('/status/dbread', function () {
    $dbRead = DB::select('SELECT * FROM `test_data` ORDER BY `name` LIMIT 0,10');
    if ($dbRead) {
    	return response(json_encode($dbRead), 200)->header('Content-Type', 'application/json');
    } else {
    	return abort(500);
    }
});


