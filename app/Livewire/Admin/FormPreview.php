<?php

namespace App\Livewire\Admin;

use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\FormSubmissionValue;
use Livewire\Component;
use Jenssegers\Agent\Agent;

class FormPreview extends Component
{
    public Form $form;

    public array $answers = [];

    public function mount(Form $form)
    {
        $this->form = $form->load('fields');

        foreach ($this->form->fields as $field) {

            $this->answers[$field->name] = '';

        }
    }

    public function submit()
    {
        $rules = [];

        foreach ($this->form->fields as $field) {

            $rules["answers.$field->name"] = $field->required
                ? 'required'
                : 'nullable';

        }

        $this->validate($rules);

        $agent = new Agent();

        $submission = FormSubmission::create([

            'form_id' => $this->form->id,

            'ip_address' => request()->ip(),

            'browser' => $agent->browser(),

            'device' => $agent->device(),

        ]);

        foreach ($this->form->fields as $field) {

            FormSubmissionValue::create([

            'form_submission_id' => $submission->id,

            'form_field_id' => $field->id,

            'value' => $this->answers[$field->name] ?? null,

        ]);

        }

        session()->flash(
            'success',
            'Form submitted successfully.'
        );

        foreach ($this->answers as $key => $value) {

            $this->answers[$key] = '';

        }
    }

    public function render()
    {
        return view('livewire.admin.form-preview')
            ->layout('layouts.app');
    }
}