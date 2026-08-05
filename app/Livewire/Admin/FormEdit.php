<?php

namespace App\Livewire\Admin;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Support\Str;
use Livewire\Component;

class FormEdit extends Component
{
    public array $collapsed = [];
    public Form $form;

    public array $fields = [];

    public function mount(Form $form)
    {
        $this->form = $form;

        $this->fields = $form->fields()
            ->orderBy('sort_order')
            ->get()
            ->map(function ($field) {

                return [

                    'id' => $field->id,

                    'label' => $field->label,

                    'name' => $field->name,

                    'type' => $field->type,

                    'placeholder' => $field->placeholder,

                    'required' => (bool) $field->required,

                    'help_text' => $field->help_text,

                    'options' => $field->options
                        ? implode("\n", $field->options)
                        : '',

                ];

            })
            ->toArray();

        foreach ($this->fields as $index => $field) {

            $this->collapsed[$index] = false;

        }
    }

    // public function addField()
    // {
    //     $this->fields[] = [
    //         'id' => null,
    //         'label' => '',
    //         'name' => '',
    //         'type' => 'text',
    //         'placeholder' => '',
    //         'required' => false,
    //         'help_text' => '',
    //         'options' => '',
    //     ];
    // }

    public function addField()
{
    $this->fields[] = [

        'id' => null,
        'label' => '',
        'name' => '',
        'type' => 'text',
        'placeholder' => '',
        'required' => false,
        'help_text' => '',
        'options' => '',

    ];

    // Add collapse state for the new field
    $this->collapsed[] = false;
}

    public function removeField($index)
    {
        unset($this->fields[$index]);

        $this->fields = array_values($this->fields);
    }

    public function toggleCollapse($index)
{
    $this->collapsed[$index] = ! $this->collapsed[$index];
}

public function duplicateField($index)
{
    $field = $this->fields[$index];

    $field['id'] = null;

    $field['label'] .= ' Copy';

    $field['name'] .= '_copy';

    array_splice($this->fields, $index + 1, 0, [$field]);

    $this->collapsed = array_fill(0, count($this->fields), false);
}

public function moveUp($index)
{
    if ($index == 0) {
        return;
    }

    [$this->fields[$index], $this->fields[$index - 1]] =
    [$this->fields[$index - 1], $this->fields[$index]];
}

public function moveDown($index)
{
    if ($index == count($this->fields) - 1) {
        return;
    }

    [$this->fields[$index], $this->fields[$index + 1]] =
    [$this->fields[$index + 1], $this->fields[$index]];
}

    // public function updatedFields($value, $key)
    // {
    //     $parts = explode('.', $key);

    //     if (($parts[1] ?? null) === 'label') {

    //         $index = $parts[0];

    //         $this->fields[$index]['name'] =
    //             Str::snake($value);
    //     }
    // }


    public function updated($property)
{
    if (preg_match('/fields\.(\d+)\.label/', $property, $matches)) {
        $index = $matches[1];

        $this->fields[$index]['name'] = Str::snake(
            $this->fields[$index]['label']
        );
    }
}

    public function saveFields()
    {
        $existingIds = [];

        foreach ($this->fields as $order => $field) {

            $record = FormField::updateOrCreate(

                [
                    'id' => $field['id'],
                ],

                [
                    'form_id' => $this->form->id,
                    'label' => $field['label'],
                    'name' => $field['name'],
                    'type' => $field['type'],
                    'placeholder' => $field['placeholder'],
                    'required' => $field['required'],
                    'help_text' => $field['help_text'],
                    'options' => $field['options']
                        ? explode("\n", $field['options'])
                        : null,
                    'sort_order' => $order + 1,
                ]

            );

            $existingIds[] = $record->id;
        }

        FormField::where('form_id', $this->form->id)
            ->whereNotIn('id', $existingIds)
            ->delete();

        session()->flash(
            'success',
            'Fields saved successfully.'
        );
    }

    public function render()
    {
        return view('livewire.admin.form-edit')
            ->layout('layouts.app');
    }
}