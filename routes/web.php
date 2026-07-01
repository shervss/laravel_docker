<?php

use App\Livewire\Pages\Tasks\Index as TasksIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/tasks', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('tasks.index');

require __DIR__.'/auth.php';
