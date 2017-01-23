<?php

Route::get('/', 'HomeController@index');
Route::post('/search', ['as' => 'home.search', 'uses' => 'HomeController@search']);
