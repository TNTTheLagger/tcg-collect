<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardController::class, 'index'])->name('home');

Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
