<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('/register', 'Auth\RegisterController@form')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');

//Route::prefix('admin')->group(function () {
//    Route::middleware('auth')->group(function () {
//        Route::namespace('admin')->group(function () {
//            Route::get('/', 'HomeController@index')->name('admin.home');
//            Route::resource('users', 'UsersController');
//        });
//    });
//});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users', 'UsersController');
});
