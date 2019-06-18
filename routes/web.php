<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@form')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth','can:admin-panel']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/users/{user}/verify', 'UsersController@verify')->name('users.verify');
    Route::resource('users', 'UsersController');
    Route::resource('regions', 'RegionController');
});
