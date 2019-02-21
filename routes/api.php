<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('departments','DepartmentController');
Route::resource('drugs','DrugController');
Route::post('drugs/excel','DrugController@excel');
Route::resource('lecturers','LecturerController');
Route::post('lecturers/excel','LecturerController@excel');
Route::resource('healths','HealthController');
Route::resource('periodics','PeriodicController');
Route::resource('troubles','TroubleController');
Route::post('periodics/{id}/report','PeriodicController@report');
Route::post('{id}/healing-history','HealthController@getHistory');
