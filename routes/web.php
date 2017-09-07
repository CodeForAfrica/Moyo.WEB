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

Route::get('/', function(){
    return redirect('login');
});

Route::get('login', [
    'uses' => 'LoginController@index',
    'as' => 'login'
]);

Route::get('auth',function(){
    return redirect('/');
});

Route::post('auth', [
    'uses' => 'AuthController@index',
    'as' => 'auth'
]);

Route::get('logout', [
    'uses' => 'LogoutController@index',
    'as' => 'logout'
]);

Route::get('dashboard', [
    'uses' => 'DashboardController@index',
    'as' => 'dashboard'
]);

// Drugs routes
Route::get('drugs', [
    'uses' => 'DrugsController@index',
    'as' => 'drugs'
]);

Route::get('drugs/viewall', [
    'uses' => 'DrugsController@viewall',
    'as' => 'drugs.viewall'
]);

Route::get('drugs/view/{id}', [
    'uses' => 'DrugsController@view',
    'as' => 'drugs.view'
]);

Route::get('drugs/edit/{id}', [
    'uses' => 'DrugsController@edit',
    'as' => 'drugs.edit'
]);

Route::get('drugs/delete/{id}', [
    'uses' => 'DrugsController@delete',
    'as' => 'drugs.delete'
]);

Route::post('drugs', [
    'uses' => 'DrugsController@update',
    'as' => 'drugs.update'
]);

Route::post('drugs/create', [
    'uses' => 'DrugsController@create',
    'as' => 'drugs.create'
]);

// Price Checks routes
Route::get('pricechecks', [
    'uses' => 'PriceChecksController@index',
    'as' => 'pricechecks'
]);

Route::get('pricechecks/viewall', [
    'uses' => 'PriceChecksController@viewall',
    'as' => 'pricechecks.viewall'
]);

Route::get('pricechecks/view/{id}', [
    'uses' => 'PriceChecksController@view',
    'as' => 'pricechecks.view'
]);

Route::get('pricechecks/delete/{id}', [
    'uses' => 'PriceChecksController@delete',
    'as' => 'pricechecks.delete'
]);

// Wrong Checks routes
Route::get('wrongchecks', [
    'uses' => 'WrongChecksController@index',
    'as' => 'wrongchecks'
]);

// Users routes
Route::get('users', [
    'uses' => 'UsersController@index',
    'as' => 'users'
]);

Route::get('users/view/{id}', [
    'uses' => 'UsersController@view',
    'as' => 'users.view'
]);

Route::get('users/edit/{id}', [
    'uses' => 'UsersController@edit',
    'as' => 'users.edit'
]);

Route::get('users/delete/{id}', [
    'uses' => 'UsersController@delete',
    'as' => 'users.delete'
]);

Route::post('users', [
    'uses' => 'UsersController@update',
    'as' => 'users.update'
]);

Route::post('users/create', [
    'uses' => 'UsersController@create',
    'as' => 'users.create'
]);