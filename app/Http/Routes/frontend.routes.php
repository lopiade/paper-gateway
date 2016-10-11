<?php
/**
 * FRONTEND Routes
 */

Route::get('/', ['uses' => 'HomeController@index']);
Route::post('/', ['uses' => 'HomeController@postSlug']);

Route::get('/{slug}', ['uses' => 'GatewayController@show', 'as' => 'paper']);

    
