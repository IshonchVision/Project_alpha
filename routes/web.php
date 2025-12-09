<?php

use Illuminate\Support\Facades\Route;

// Route::view('/{any}', 'dashboard')->where('any', '.*');


// website url

Route::get('/' , function (){
    return view('index');
});

