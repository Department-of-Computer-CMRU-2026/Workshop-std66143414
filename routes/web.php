<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\ActivityManager;
use App\Livewire\Admin\RegistrationList;
use App\Livewire\Activities\ActivityList;
use App\Livewire\Activities\MyRegistrations;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('activities.index');
        }
        )->name('dashboard');

        // Student Routes
        Route::get('/activities', ActivityList::class)->name('activities.index');
        Route::get('/my-activities', MyRegistrations::class)->name('activities.my');

        // Admin Routes
        Route::middleware(['admin'])->prefix('admin')->group(function () {
            Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
            Route::get('/activities', ActivityManager::class)->name('admin.activities');
            Route::get('/registrations/{activity}', RegistrationList::class)->name('admin.registrations');
        }
        );    });

require __DIR__ . '/settings.php';

