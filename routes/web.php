<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PublicDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicDashboardController::class, 'index'])->name('dashboard');
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');
Route::get('/reports/{report}/download', [PublicDashboardController::class, 'downloadReport'])->name('reports.download');
