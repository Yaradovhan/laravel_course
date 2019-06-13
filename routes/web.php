<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/register', 'Auth\RegisterController@form')->name('register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');
