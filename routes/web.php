<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard as HomeDasboard;


Route::view('/', 'welcome')->name('home');
Route::get('/dashboard', HomeDasboard::class)->name('home.dashboard');
