<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable = [

        'form_id',
        'label',
        'name',
        'type',
        'placeholder',
        'help_text',
        'default_value',
        'required',
        'options',
        'validation',
        'sort_order',
        'parent_field_id',
        'condition_operator',
        'condition_value',

    ];

    protected $casts = [

        'required' => 'boolean',

        'options' => 'array',

        'validation' => 'array'

    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function submissionValues()
    {
        return $this->hasMany(FormSubmissionValue::class);
    }

    public function getIsSelectAttribute()
    {
        return in_array($this->type, [

            'select',

            'radio',

            'checkbox'

        ]);
    }

    public function getValidationRulesAttribute()
    {
        return $this->validation ?? [];
    }

    public function parentField()
{
    return $this->belongsTo(
        FormField::class,
        'parent_field_id'
    );
}

public function childFields()
{
    return $this->hasMany(
        FormField::class,
        'parent_field_id'
    );
}
}