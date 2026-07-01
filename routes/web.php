<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\Tasks\Index as TasksIndex;
use App\Livewire\Pages\Admin\Dashboard as AdminDashboard;
use App\Livewire\Pages\Admin\Users\Index as AdminUsersIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin', AdminDashboard::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/users', AdminUsersIndex::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/tasks', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('tasks.index');
    
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');

require __DIR__.'/auth.php';