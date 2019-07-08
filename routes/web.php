<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@form')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::group([
    'prefix' => 'cabinet',
    'as' => 'cabinet.',
    'namespace' => 'Cabinet',
    'middleware' => ['auth']
], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', 'ProfileController@index')->name('home');
        Route::get('/edit', 'ProfileController@edit')->name('edit');
        Route::put('/update', 'ProfileController@update')->name('update');
        Route::post('/phone', 'PhoneController@request');
        Route::get('/phone', 'PhoneController@form')->name('phone');
        Route::put('/phone', 'PhoneController@verify')->name('phone.verify');
        Route::post('/phone/auth', 'PhoneController@auth')->name('phone.auth');
    });
});

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

    Route::group(['prefix'=>'adverts', 'as'=>'adverts.', 'namespace'=>'Adverts'], function(){
        Route::resource('categories', 'CategoryController');

        Route::group(['prefix' => 'categories/{category}', 'as' => 'categories.'], function () {
            Route::post('/first', 'CategoryController@first')->name('first');
            Route::post('/up', 'CategoryController@up')->name('up');
            Route::post('/down', 'CategoryController@down')->name('down');
            Route::post('/last', 'CategoryController@last')->name('last');
            Route::resource('attributes', 'AttributeController')->except('index');
        });
    });
});
