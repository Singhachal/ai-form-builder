<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FormEdit extends Component
{
    public function render()
    {
        return view('livewire.admin.form-edit')
        ->layout('layouts.app');
    }
}
