<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AIGeneration;

class AIHistory extends Component
{
    public function render()
    {
        return view('livewire.admin.ai-history', [
            'histories' => AIGeneration::latest()->paginate(10),
        ])->layout('layouts.app');
    }
}