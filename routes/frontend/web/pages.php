<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'index'])->name('main');

Route::group([
    'prefix' => 'page',
    'as' => '.page.',
], function () {

});
