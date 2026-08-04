<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSubmission;
use App\Models\FormSubmissionValue;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Form::factory(5)

            ->create()

            ->each(function ($form) {

                $fields = FormField::factory(8)

                    ->make();

                foreach ($fields as $field) {

                    $field->form_id = $form->id;

                    $field->save();

                }

                FormSubmission::factory(20)

                    ->create([

                        'form_id' => $form->id

                    ])

                    ->each(function ($submission) use ($form) {

                        foreach ($form->fields as $field) {

                            FormSubmissionValue::factory()

                                ->create([

                                    'form_submission_id' => $submission->id,

                                    'form_field_id' => $field->id,

                                ]);

                        }

                    });

            });
    }
}