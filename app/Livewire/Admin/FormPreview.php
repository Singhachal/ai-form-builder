<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FormPreview extends Component
{
    public function render()
    {
        return view('livewire.admin.form-preview')
        ->layout('layouts.app');
    }
}