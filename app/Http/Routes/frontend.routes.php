<?php
/**
 * FRONTEND Routes
 */

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::post('/', ['uses' => 'HomeController@postSlug']);

Route::get('/{slug}', ['uses' => 'GatewayController@show', 'as' => 'paper']);

    
Route::group(['prefix'=>'api'],function(){

    Route::post('/resource/{id}', ['uses' => 'ResourceHttpController@checkHttp']);

});