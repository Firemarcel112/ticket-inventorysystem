<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('/', 'HomeController@index')->name('startseite');

Route::controller('HomeController')->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller('LoginController')->group(function () {
    Route::get('login', 'index')->name('login');

    Route::post('logout', 'logout')->name('logout');
    Route::post('action/login', 'authenticate')->name('loginPost');
});


Route::prefix('faq')->group(function () {
    Route::controller('FaqController')->group(function () {
        Route::get('/', 'index')->name('faq.dashboard');
        Route::get('artikel/{title}', 'show')->name('faq.article');
    });
});

Route::prefix('qrcode')->group(function () {
    Route::controller('QRCodeController')->group(function () {
        Route::get('/', 'index')->name('qrcode');
        Route::post('action/post', 'post')->name('qrcodePost');
    });
});

