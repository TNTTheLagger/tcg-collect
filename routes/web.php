<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardController::class, 'index'])->name('cards.index');

Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
Route::get('/cards/manage', [CardController::class, 'manage'])->name('cards.manage');
Route::post('/cards/manage', [CardController::class, 'store'])->name('cards.store');
Route::get('/cards/{card_name}', [CardController::class, 'show'])->name('cards.show');
