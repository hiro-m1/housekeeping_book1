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


// Auth::routes();

Route::group(['prefix' => 'subject', 'middleware' => 'auth'], function(){
    Route::get('index', 'SubjectController@index')->name('subject.index');
    Route::get('create', 'SubjectController@create')->name('subject.create');
    Route::post('store', 'SubjectController@store')->name('subject.store');
    Route::get('edit/{id}', 'SubjectController@edit')->name('subject.edit');
    Route::post('update/{id}', 'SubjectController@update')->name('subject.update');
    Route::post('destroy/{id}', 'SubjectController@destroy')->name('subject.destroy');
});

Route::group(['prefix' => 'bank', 'middleware' => 'auth'], function(){
    Route::get('index', 'BankController@index')->name('bank.index');
    Route::get('create', 'BankController@create')->name('bank.create');
    Route::post('store', 'BankController@store')->name('bank.store');
    Route::get('edit/{id}', 'BankController@edit')->name('bank.edit');
    Route::post('update/{id}', 'BankController@update')->name('bank.update');
    Route::post('destroy/{id}', 'BankController@destroy')->name('bank.destroy');
});

Route::group(['prefix' => 'method', 'middleware' => 'auth'], function(){
    Route::get('index', 'MethodController@index')->name('method.index');
    Route::get('create', 'MethodController@create')->name('method.create');
    Route::post('store', 'MethodController@store')->name('method.store');
    Route::get('edit/{id}', 'MethodController@edit')->name('method.edit');
    Route::post('update/{id}', 'MethodController@update')->name('method.update');
    Route::post('destroy/{id}', 'MethodController@destroy')->name('method.destroy');
});

Route::resource('subjects', 'SubjectController')->only([
    'index', 'show'
]);


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
