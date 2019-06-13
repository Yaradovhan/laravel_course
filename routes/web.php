<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/cabinet', 'Cabinet\HomeController@index')->name('cabinet');
