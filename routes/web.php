<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/register', 'Auth\RegisterController@register')->name('register');

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');
