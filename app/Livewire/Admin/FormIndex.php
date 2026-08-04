<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FormIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.form-index')
        ->layout('layouts.app');
    }
}
