<?php

use Illuminate\Http\Request;

Route::get('/import', function (Request $request) {
    return $request->user();
});
