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

Route::group(['middleware'=>'auth','prefix'=>'api/v1'], function()
{
  Route::get('/classrooms','API\V1\ClassRoomController@index');
  Route::get('/students','API\V1\ClassRoomController@students');
  Route::get('/exams','API\V1\ExamController@index');
  Route::post('/exam/create','API\V1\ExamController@store');
  Route::get('/subjects','API\V1\ExamController@show');
  Route::get('/exam','API\V1\ExamController@exam');
});
