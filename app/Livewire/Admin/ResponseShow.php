<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\FormSubmission;

class ResponseShow extends Component
{
    public FormSubmission $response;

    public function mount(FormSubmission $response)
    {
        $this->response = $response->load(
            'form',
            'values.field'
        );
    }

    public function render()
    {
        return view(
            'livewire.admin.response-show'
        )->layout('layouts.app');
    }
}