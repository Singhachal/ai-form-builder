<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\AIGeneration;

class Dashboard extends Component
{
    public $totalForms;
    public $totalSubmissions;
    public $totalAIGenerated;
    public $publicForms;

    public function mount()
    {
        $this->totalForms = Form::count();

        $this->totalSubmissions = FormSubmission::count();

        $this->totalAIGenerated = AIGeneration::count();

        $this->publicForms = Form::where('is_public', true)->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.app');
    }
}