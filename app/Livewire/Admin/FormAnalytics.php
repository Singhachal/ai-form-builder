<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormSubmission;
use Symfony\Component\HttpFoundation\StreamedResponse;


class FormAnalytics extends Component
{
    public Form $form;

    public function mount(Form $form)
    {
        $this->form = $form;
    }

    public function render()
    {
        $totalSubmissions = FormSubmission::where(
            'form_id',
            $this->form->id
        )->count();

        $mobile = FormSubmission::where(
            'form_id',
            $this->form->id
        )->where('device', 'Mobile')->count();

        $desktop = FormSubmission::where(
            'form_id',
            $this->form->id
        )->where('device', 'Desktop')->count();

        return view(
            'livewire.admin.form-analytics',
            compact(
                'totalSubmissions',
                'mobile',
                'desktop'
            )
        )->layout('layouts.app');
    }

  public function export()
{
    $filename = 'form-' . $this->form->id . '-submissions.csv';

    return response()->streamDownload(function () {

        $handle = fopen('php://output', 'w');

        // Get all fields for this form
        $fields = $this->form->fields()->orderBy('sort_order')->get();

        // CSV Header
        $header = ['Submission ID'];

        foreach ($fields as $field) {
            $header[] = $field->label;
        }

        $header[] = 'Device';
        $header[] = 'Browser';
        $header[] = 'IP Address';
        $header[] = 'Submitted At';

        fputcsv($handle, $header);

        // Get submissions
        $submissions = FormSubmission::where('form_id', $this->form->id)
            ->with('values')
            ->get();

        foreach ($submissions as $submission) {

            $row = [
                $submission->id,
            ];

            foreach ($fields as $field) {

                $value = $submission->values
                    ->where('form_field_id', $field->id)
                    ->first();

                $row[] = $value ? $value->value : '';
            }

            $row[] = $submission->device;
            $row[] = $submission->browser;
            $row[] = $submission->ip_address;
            $row[] = $submission->created_at;

            fputcsv($handle, $row);
        }

        fclose($handle);

    }, $filename);
}
}