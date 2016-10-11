<?php
/**
 * BACKEND Routes
 */


$this->get('login', 'Auth\AuthController@showLoginForm');
$this->post('login', 'Auth\AuthController@login');
$this->get('logout', 'Auth\AuthController@logout');

Route::get('/', ['uses' => 'Admin\DashboardController@index', 'as' => 'admin::dashboard']);
Route::get('/paper', ['uses' => 'Admin\PaperController@create', 'as' => 'admin::paper::create::form']);
Route::post('/paper', ['uses' => 'Admin\PaperController@store', 'as' => 'admin::paper::store']);
Route::get('/paper/{id}', ['uses' => 'Admin\PaperController@show', 'as' => 'admin::paper::show']);
Route::delete('/paper/{id}', ['uses' => 'Admin\PaperController@destroy', 'as' => 'admin::paper::delete']);

Route::post('/paper/{id}/resource', ['uses' => 'Admin\PaperResourceController@store', 'as' => 'admin::paper::resource::store']);

Route::delete('/paper/{id}/resource/{resource_id}', ['uses' => 'Admin\PaperResourceController@destroy', 'as' => 'admin::paper::resource::delete']);


