<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

// Route to display the upload form and list of images
Route::get('/', [ImageController::class, 'uploadForm'])->name('upload.form');

// Route to handle the image upload
Route::post('/upload', [ImageController::class, 'upload'])->name('upload.image');
