<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/jobs/company-profile/{action?}', [CompanyController::class, 'create'])->name('job.company-profile');
Route::post('/jobs/company-profile', [CompanyController::class, 'store'])->name('job.submit-company-profile');

Route::get('/jobs/create', [JobAdminController::class, 'create'])->name('job.description');
Route::post('/jobs/create', [JobAdminController::class, 'store'])->name('job.submit-description');
Route::post('/jobs/publish/{job}', [JobAdminController::class, 'publish'])->name('job.publish');
Route::get('/jobs/preview/{job:slug}', [JobAdminController::class, 'preview'])->name('job.preview');
Route::get('/jobs/manage', [JobAdminController::class, 'index'])->name('manage_jobs');

Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::post('/account', [AccountController::class, 'update'])->name('account.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');