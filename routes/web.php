<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FormIndex;
use App\Livewire\Admin\FormCreate;
use App\Livewire\Admin\FormEdit;
use App\Livewire\Admin\FormPreview;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


    Route::middleware(['auth', 'verified'])->group(function () {

    // Route::view('/dashboard', 'dashboard')
    //     ->name('dashboard');

    // Route::view('/profile', 'profile')
    //     ->name('profile');

    // Form Builder
    Route::get('/forms', FormIndex::class)
        ->name('forms.index');

    Route::get('/forms/create', FormCreate::class)
        ->name('forms.create');

    Route::get('/forms/{form}/edit', FormEdit::class)
        ->name('forms.edit');
});

Route::get('/forms/{form:slug}', FormPreview::class)
    ->name('forms.preview');

require __DIR__.'/auth.php';
