<?php

use App\Http\Controllers\Ai21IntegrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [Ai21IntegrationController::class, "index"])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/generate-ai-response', [Ai21IntegrationController::class, "getAiResponse"])->middleware(['auth', 'verified'])->name('getAiResponse');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
