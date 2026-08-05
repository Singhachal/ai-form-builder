<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FormSubmission;
use App\Models\Form;

class ResponseIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $form = '';
    public $date = '';
    public $sort = 'latest';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingForm()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }

    public function updatingSort()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->form = '';
        $this->date = '';
        $this->sort = 'latest';
        $this->resetPage();
    }

    public function render()
    {
        $responses = FormSubmission::with('form')

            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%')
                    ->orWhereHas('form', function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%');
                    });
            })

            ->when($this->form, function ($query) {
                $query->where('form_id', $this->form);
            })

            ->when($this->date, function ($query) {
                $query->whereDate('created_at', $this->date);
            });

        if ($this->sort == 'latest') {
            $responses->latest();
        } else {
            $responses->oldest();
        }

        return view('livewire.admin.response-index', [
            'responses' => $responses->paginate(10),
            'forms' => Form::orderBy('title')->get(),
        ])->layout('layouts.app');
    }
}