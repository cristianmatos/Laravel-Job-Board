<?php
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs/{job:slug}', [JobController::class, 'show'])->name('job.view');
Route::get('/search', [JobController::class, 'search']);
Route::get('/load-more-jobs', [JobController::class, 'more']);
Route::get('/', [HomeController::class, 'index']);