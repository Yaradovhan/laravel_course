<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/login/phone', 'Auth\LoginController@phone')->name('login.phone');
Route::post('/login/phone', 'Auth\LoginController@verify');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/register', 'Auth\RegisterController@form')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/ajax/regions', 'Ajax\RegionController@get')->name('ajax.regions');
Route::get('/ajax/address', 'Ajax\AddressController@get')->name('ajax.address');

Route::group([
    'prefix' => 'adverts',
    'as' => 'adverts.',
    'namespace' => 'Adverts',
], function () {
    Route::get('/show/{advert}', 'AdvertController@show')->name('show');
    Route::post('/show/{advert}/phone', 'AdvertController@phone')->name('phone');
    Route::post('/show/{advert}/favorites', 'FavoriteController@add')->name('favorites');
    Route::delete('/show/{advert}/favorites', 'FavoriteController@remove');

    Route::get('/{adverts_path?}', 'AdvertController@index')->name('index')->where('adverts_path', '.+');
});

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

    Route::resource('/adverts', 'Adverts\AdvertController');

    Route::group([
        'prefix' => 'adverts',
        'as' => 'adverts.',
        'namespace' => 'Adverts',
        'middleware' => [App\Http\Middleware\FilledProfile::class],
    ], function () {
        Route::get('/', 'AdvertController@index')->name('index');
        Route::get('/create', 'CreateController@category')->name('create');
        Route::get('/create/region/{category}/{region?}', 'CreateController@region')->name('create.region');
        Route::get('/create/advert/{category}/{region?}', 'CreateController@advert')->name('create.advert');
        Route::post('/create/advert/{category}/{region?}', 'CreateController@store')->name('create.advert.store');

        Route::get('/{advert}/edit', 'ManageController@editForm')->name('edit');
        Route::put('/{advert}/edit', 'ManageController@edit');
        Route::get('/{advert}/photos', 'ManageController@photosForm')->name('photos');
        Route::post('/{advert}/photos', 'ManageController@photos');
        Route::get('/{advert}/attributes', 'ManageController@attributesForm')->name('attributes');
        Route::post('/{advert}/attributes', 'ManageController@attributes');
        Route::post('/{advert}/send', 'ManageController@send')->name('send');
        Route::post('/{advert}/close', 'ManageController@close')->name('close');
        Route::delete('/{advert}/destroy', 'ManageController@destroy')->name('destroy');
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

Route::group([
    'prefix' => 'adverts',
    'as' => 'adverts.',
    'namespace' => 'Adverts',
], function () {
    Route::get('/show/{advert}', 'AdvertController@show')->name('show');
    Route::post('/show/{advert}/phone', 'AdvertController@phone')->name('phone');
    Route::post('/show/{advert}/favorites', 'FavoriteController@add')->name('favorites');
    Route::delete('/show/{advert}/favorites', 'FavoriteController@remove');

    Route::get('/{adverts_path?}', 'AdvertController@index')->name('index')->where('adverts_path', '.+');
});
