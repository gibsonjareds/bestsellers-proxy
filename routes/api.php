<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/1/nyt/best-sellers', 'App\\Http\\Controllers\\NytController@get' );
