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

Route::group(['middleware' => 'check.login'],function(){
    Route::get('/',['uses' => 'HomeController@index','as' => 'home']);
    Route::resource('/lecturers','LecturerController')->middleware('check.bomon');
    Route::resource('/departments','DepartmentController')->middleware('check.bomon');
    Route::resource('/drugs','DrugController')->middleware('check.yte');
    Route::resource('/healths','HealthController')->middleware('check.yte');
    Route::resource('/periodics','PeriodicController')->middleware('check.yte');
});
Route::get('/login',['uses' => 'AuthController@login','as' => 'login']);
Route::get('/logout',['uses' => 'AuthController@logout','as' => 'logout']);
Route::post('/login',['uses' => 'AuthController@postLogin','as' => 'login']);
