<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\FormIndex;
use App\Livewire\Admin\FormCreate;
use App\Livewire\Admin\FormEdit;
use App\Livewire\Admin\FormPreview;
use App\Livewire\Admin\AIFormGenerator;
use App\Livewire\Admin\AIHistory;
use App\Livewire\Admin\FormImporter;
use App\Livewire\Admin\ResponseIndex;
use App\Livewire\Admin\ResponseShow;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\FormAnalytics;


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

    Route::get('/forms/ai-generator', AIFormGenerator::class)
        ->name('forms.ai');
    Route::get('/forms/ai-history', AIHistory::class)
    ->name('forms.ai.history');
    Route::get('/forms/import', FormImporter::class)
    ->name('forms.import');
    Route::get('/responses', ResponseIndex::class)
    ->name('responses.index');
    Route::get('/responses/{response}', ResponseShow::class)
    ->name('responses.show');
    Route::get('/dashboard', Dashboard::class)
    ->name('dashboard');
    Route::get('/forms/{form}/analytics', FormAnalytics::class)
    ->name('forms.analytics');
    
});

Route::get('/forms/{form:slug}', FormPreview::class)
    ->name('forms.preview');

require __DIR__.'/auth.php';
