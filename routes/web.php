<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseRequirementController;
use App\Http\Controllers\ClerkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JudgeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Home Route
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // System Admin Route
    Route::put('/dashboard/{id}', [JudgeController::class, 'update']);
    Route::delete('/dashboard/{id}', [JudgeController::class, 'destroy']);
    Route::get('/requirement-details', [CaseRequirementController::class, 'index'])->name('requirement-details');
    Route::post('/requirement-details/submit', [CaseRequirementController::class, 'store']);
    Route::put('/requirement-details/{id}', [CaseRequirementController::class, 'update']);
    Route::delete('/requirement-details/{id}', [CaseRequirementController::class, 'destroy']);
    Route::get('/admin-management', function () {
        if (Auth::user()->usertype == 'admin') {
            return view('appealEase.systemAdmin.admin-management.main');
        }
    })->name('admin-management');
    Route::post('/admin-management', [RegisteredUserController::class, 'store']);

    // CAMIS Route
    Route::post('/dashboard/camis/submit', [CaseController::class, 'store']);
    Route::delete('/dashboard/camis/{id}', [CaseController::class, 'destroy']);
    // routes/web.php
    Route::post('/dashboard/camis/send/{id}', [CaseController::class, 'send']);

    // CLERK Route
    Route::post('/dashboard/cases/randomize/{id}', [CaseController::class, 'assignRandomJudge']);
    
    // routes/web.php
    // Route::post('/clerk/cases/{case_number}/receive', [ClerkController::class, 'markAsReceived'])->name('clerk.cases.receive');



    // Division Route
});
