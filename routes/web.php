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

use App\Idea;

Route::get('/', function () {
    return view('home');
});

Route::get('/ideas', 'IdeasController@index');
Route::get('/new-idea', 'IdeasController@create');


// REST API
Route::post('/ideas', 'IdeasController@store');

Route::get('/api/ideas/get/{offset}', function ($offset) {
    $c = new App\Http\Controllers\IdeasController();
    return response($c->listByOffset($offset))->header('Content-Type', 'application/json');
});

Route::get('/api/ideas/count', function () {
    $c = new App\Http\Controllers\IdeasController();
    return response([$c->ideaCount()])->header('Content-Type', 'application/json');
});




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


