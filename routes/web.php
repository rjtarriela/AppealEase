<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\CaseRequirementController;
use App\Http\Controllers\ClerkController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\LinkController;
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
    Route::get('/dashboard', [LinkController::class, 'nav1'])->name('dashboard');

    // System Admin Route
    Route::put('/dashboard/{id}', [JudgeController::class, 'update']);
    Route::delete('/dashboard/{id}', [JudgeController::class, 'destroy']);

    Route::get('/dashboard/judge/{id}/cases', [CaseController::class, 'viewJudgeCases']);


    Route::get('/requirement-details', [LinkController::class, 'nav2'])->name('requirement-details');
    Route::post('/requirement-details/submit', [CaseRequirementController::class, 'store']);
    Route::put('/requirement-details/{id}', [CaseRequirementController::class, 'update']);
    Route::delete('/requirement-details/{id}', [CaseRequirementController::class, 'destroy']);

    Route::get('/admin-management', [LinkController::class, 'nav3'])->name('admin-management');
    Route::post('/admin-management', [RegisteredUserController::class, 'store']);

    // CAMIS Route
    Route::post('/dashboard/camis/submit', [CaseController::class, 'store']);
    Route::delete('/dashboard/camis/{id}', [CaseController::class, 'destroy']);
    Route::get('/approved-cases', [LinkController::class, 'nav2'])->name('approved-cases');
    Route::get('/denied-cases', [LinkController::class, 'nav3'])->name('denied-cases');
    Route::put('/denied-cases/edit-requirements/{id}', [CaseController::class, 'update'])->name('cases.update');

    // routes/web.php
    Route::post('/dashboard/camis/send/{id}', [CaseController::class, 'send']);
    Route::post('/approved-cases/send-to-supremeCourt/{id}', [CaseController::class, 'sendToSupremeCourt']);
    Route::post('/dashboard/case-done/{id}', [CaseController::class, 'doneEdit']);
    

    // CLERK Route
    Route::post('/dashboard/cases/randomize/{id}', [CaseController::class, 'assignRandomDivision']);
    // routes/web.php
    // Route::post('/clerk/cases/{case_number}/receive', [ClerkController::class, 'markAsReceived'])->name('clerk.cases.receive');

    // JUDGE Route
    Route::post('/dashboard/judge-approved/{id}', [CaseController::class, 'approved']);
    Route::post('/dashboard/judge-denied/{id}', [CaseController::class, 'denied']);
    Route::post('/dashboard/judge-complete/{id}', [CaseController::class, 'storeDecision']);
    Route::get('/judgeProfile', [LinkController::class, 'nav2'])->name('judgeProfile');
    

    // DIVISION
    Route::get('/judge/update-role/{id}/{role}', [JudgeController::class, 'updateRole'])->name('judge.updateRole');
});
