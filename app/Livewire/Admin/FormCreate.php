<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FormCreate extends Component
{
    public function render()
    {
        return view('livewire.admin.form-create')
        ->layout('layouts.app');
    }
}
