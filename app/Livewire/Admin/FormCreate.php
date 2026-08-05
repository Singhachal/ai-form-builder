<?php

// namespace App\Livewire\Admin;

// use Livewire\Component;

// class FormCreate extends Component
// {
//     public function render()
//     {
//         return view('livewire.admin.form-create')
//         ->layout('layouts.app');
//     }
// }

namespace App\Livewire\Admin;

use App\Models\Form;
use Illuminate\Support\Str;
use Livewire\Component;

class FormCreate extends Component
{
    public string $title = '';

    public string $description = '';

    public bool $is_active = true;

    public bool $is_public = true;

    protected function rules()
    {
        return [

            'title' => 'required|min:3|max:255',

            'description' => 'nullable|max:1000',

            'is_active' => 'boolean',

            'is_public' => 'boolean',

        ];
    }

    public function save()
    {
        $this->validate();

        Form::create([

            'title' => $this->title,

            'slug' => Str::slug($this->title) . '-' . time(),

            'description' => $this->description,

            'is_active' => $this->is_active,

            'is_public' => $this->is_public,

        ]);

        session()->flash('success', 'Form created successfully.');

        return redirect()->route('forms.index');
    }

    public function render()
    {
        return view('livewire.admin.form-create')
            ->layout('layouts.app');
    }
}