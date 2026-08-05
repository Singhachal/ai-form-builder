<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormField;
use App\Models\AIGeneration;
use App\Services\AIFormGenerator as AIService;
use Illuminate\Support\Str;

class AIFormGenerator extends Component
{
    public string $prompt = '';

    public function generate(AIService $ai)
{
    $this->validate([
        'prompt' => 'required|min:10',
    ]);

    try {

        // Generate form JSON using AI
        $json = $ai->generate($this->prompt);

        // Create Form
        $form = Form::create([
            'title' => $json['title'],
            'slug' => Str::slug($json['title']) . '-' . time(),
            'description' => $json['description'],
            'is_active' => true,
            'is_public' => false,
        ]);

        // Create Form Fields
        foreach ($json['fields'] as $index => $field) {

            FormField::create([
                'form_id'      => $form->id,
                'label'        => $field['label'],
                'name'         => Str::snake($field['label']),
                'type'         => $field['type'],
                'placeholder'  => $field['placeholder'] ?? null,
                'help_text'    => $field['help_text'] ?? null,
                'required'     => $field['required'] ?? false,
                'options'      => $field['options'] ?? null,
                'sort_order'   => $index + 1,
            ]);
        }

        // Save AI Generation History
        AIGeneration::create([
            'prompt'   => $this->prompt,
            'form_id'  => $form->id,
            'response' => $json,
        ]);

        session()->flash('success', 'AI form generated successfully!');

        return redirect()->route('forms.edit', $form);

    } catch (\Throwable $e) {

        session()->flash(
            'error',
            'AI generation failed. Your  API key may have exceeded its quota or is invalid.'
        );

        // Uncomment for debugging only:
        // dd($e->getMessage());

        return;
    }
}

    public function render()
    {
        return view('livewire.admin.ai-form-generator')
            ->layout('layouts.app');
    }
}