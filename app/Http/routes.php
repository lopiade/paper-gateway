<?php
//
//Route::group(['middleware' => ['web']], function () {
//    Route::auth();
//});
//


// BACKEND
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function(){

    $file = app_path('Http/Routes/backend.routes.php');

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }

});


// FRONTEND
Route::group(['middleware' => ['web']], function () {

    $file = app_path('Http/Routes/frontend.routes.php');

    if (file_exists($file)) {
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }

});



