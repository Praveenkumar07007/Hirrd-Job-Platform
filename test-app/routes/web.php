<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\JweleryController;


Route::controller(JweleryController::class)->group(function () {
    Route::get('/Jwelery', 'index')->name('Jwelery.index'); // List all students
    Route::get('/Jwelery/{id}', 'show')->name('Jwelery.show'); // Show student details
});
