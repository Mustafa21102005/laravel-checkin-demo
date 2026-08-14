<?php

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::resource('events', EventController::class)->only(['index', 'create', 'store', 'show']);

Route::post('events/{event}/tokens', [CheckinController::class, 'generate'])->name('events.tokens.generate');

Route::get('checkin', [CheckinController::class, 'deskShow'])->name('checkin.desk');

Route::post('checkin', [CheckinController::class, 'redeem'])->name('checkin.redeem');
