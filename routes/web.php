<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    // return view('auth.login');
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Home Route
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // System Admin Route
    Route::get('/requirement-details', function () {
        if (Auth::user()->usertype == 'admin') {
        return view('appealEase.systemAdmin.requirement-details.main');
        }
    })->name('requirement-details');
    Route::get('/admin-management', function () {
        if (Auth::user()->usertype == 'admin') {
        return view('appealEase.systemAdmin.admin-management.main');
        }
    })->name('admin-management');
    Route::post('/admin-management', [RegisteredUserController::class, 'store']);
        // Route::post('/admin-management', [RegisteredUserController::class, 'create']);

    // CAMIS Route

    // CLERK Route

    // Division Route
});
