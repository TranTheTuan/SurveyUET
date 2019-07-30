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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function () {
    Route::get('/', 'SurveyController@home')->name('home');
    Route::get('/create', 'SurveyController@create')->name('create');
    Route::post('/store', 'SurveyController@store')->name('store');
    Route::get('/edit/{survey}', 'SurveyController@edit')->name('edit')->where(['survey' => '[0-9]+']);
    Route::post('/update/{survey}', 'SurveyController@update')->name('update')->where(['survey' => '[0-9]+']);
    Route::get('/delete/{survey}', 'SurveyController@delete')->name('delete')->where(['survey' => '[0-9]+']);
    Route::get('/survey/{survey}', 'SurveyController@show')->name('show')->where(['survey' => '[0-9]+']);
    Route::post('/add_question/{survey}', 'SurveyController@addQuestion')->name('add_question')->where(['survey' => '[0-9]+']);
    Route::get('/take_survey/{survey}', 'SurveyController@takeSurvey')->name('take')->where(['survey' => '[0-9]+']);
    Route::post('/take_survey/{survey}', 'SurveyController@postAnswers')->name('post')->where(['survey' => '[0-9]+']);
    Route::get('/statistic/{survey}', 'SurveyController@statistic')->name('statistic')->where(['survey' => '[0-9]+']);
});

Auth::routes();
