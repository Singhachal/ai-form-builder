<?php

// namespace App\Livewire\Admin;

// use Livewire\Component;

// class FormIndex extends Component
// {
//     public function render()
//     {
//         return view('livewire.admin.form-index')
//         ->layout('layouts.app');
//     }
// }


namespace App\Livewire\Admin;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;


class FormIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    
    public $search = '';
    public $status = '';
    public $visibility = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $forms = Form::withCount([
                'fields',
                'submissions'
            ])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                      ->orWhere('description', 'like', "%{$this->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.form-index', [
            'forms' => $forms,
            'totalForms' => Form::count(),
            'activeForms' => Form::where('is_active', 1)->count(),
            'publicForms' => Form::where('is_public', 1)->count(),
            'totalSubmissions' => \App\Models\FormSubmission::count(),
        ])->layout('layouts.app');
    }

    public function delete($id)
{
    $form = \App\Models\Form::findOrFail($id);

    $form->delete();

    session()->flash('success', 'Form deleted successfully.');
}
}
