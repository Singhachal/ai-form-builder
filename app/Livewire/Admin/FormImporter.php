<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\Import\FormImportService;

class FormImporter extends Component
{
    use WithFileUploads;

    public $file;

    public function import(FormImportService $service)
{
    $this->validate([
        'file' => 'required|file|mimes:docx,xlsx',
    ]);

    //   dd($this->file);

    $form = $service->import($this->file);

    session()->flash(
        'success',
        'Form imported successfully.'
    );

    return redirect()->route(
        'forms.edit',
        $form
    );
}

    public function render()
    {
        return view('livewire.admin.form-importer')
            ->layout('layouts.app');
    }
}