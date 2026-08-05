<?php

namespace App\Services\Import;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory as WordReader;
use PhpOffice\PhpSpreadsheet\IOFactory as ExcelReader;


class FormImportService
{
    public function import($file)
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension === 'docx') {
            return $this->importWord($file);
        }

        if ($extension === 'xlsx') {
            return $this->importExcel($file);
        }

        throw new \Exception('Unsupported file type.');
    }

    protected function createForm(array $fields, string $title)
    {
        $form = Form::create([
            'title' => $title,
            'slug' => Str::slug($title) . '-' . time(),
            'description' => 'Imported Form',
            'is_active' => true,
            'is_public' => false,
        ]);

        foreach ($fields as $index => $label) {

            FormField::create([
                'form_id' => $form->id,
                'label' => $label,
                'name' => Str::snake($label),
                'type' => 'text',
                'required' => false,
                'sort_order' => $index + 1,
            ]);
        }

        return $form;
    }

  protected function importWord($file)
{
    $document = WordReader::load($file->getRealPath());

    $fields = [];

    foreach ($document->getSections() as $section) {

        foreach ($section->getElements() as $element) {

            if (method_exists($element, 'getText')) {

                $text = trim($element->getText());

                if (!$text) {
                    continue;
                }

                // Skip document title
                if (strtolower($text) == 'form') {
                    continue;
                }

                // Remove underline characters
                $text = preg_replace('/_+/', '', $text);

                // Remove colon from end
                $text = rtrim($text, ':');

                $text = trim($text);

                if ($text != '') {
                    $fields[] = $text;
                }
            }
        }
    }

    return $this->createForm($fields, 'Imported Word Form');
}

   protected function importExcel($file)
{
    $spreadsheet = ExcelReader::load($file->getRealPath());

    $sheet = $spreadsheet->getActiveSheet();

    $rows = $sheet->toArray();

    if (count($rows) <= 1) {
        throw new \Exception('Excel file is empty.');
    }

    $form = Form::create([
        'title' => 'Imported Excel Form',
        'slug' => Str::slug('Imported Excel Form').'-'.time(),
        'description' => 'Imported from Excel',
        'is_active' => true,
        'is_public' => false,
    ]);

    foreach (array_slice($rows, 1) as $index => $row) {

        if (empty($row[0])) {
            continue;
        }

        FormField::create([
            'form_id' => $form->id,
            'label' => trim($row[0]),
            'name' => Str::snake($row[0]),
            'type' => $row[1] ?: 'text',
            'required' => strtolower($row[2] ?? '') == 'yes',
            'placeholder' => $row[3] ?? null,
            'sort_order' => $index + 1,
        ]);
    }

    return $form;
}
}