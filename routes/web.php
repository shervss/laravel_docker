<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Tasks\Index as TasksIndex;
use App\Livewire\Pages\Admin\Dashboard as AdminDashboard;
use App\Livewire\Pages\Admin\Users\Index as AdminUsersIndex;
use App\Livewire\Pages\Admin\ActivityLogs\Index as AdminActivityLogsIndex;

Route::view('/', 'welcome');

Route::get('/dashboard', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/tasks', TasksIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('tasks.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/admin', AdminDashboard::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/users', AdminUsersIndex::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.users.index');

Route::get('/admin/activity-logs', AdminActivityLogsIndex::class)
    ->middleware(['auth', 'role:admin'])
    ->name('admin.activity-logs.index');

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');

require __DIR__.'/auth.php';