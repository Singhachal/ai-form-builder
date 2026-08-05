<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [

        'form_id',

        'ip_address',

        'browser',

        'device'

    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function values()
    {
        return $this->hasMany(FormSubmissionValue::class);
    }

    public function getTotalAnswersAttribute()
    {
        return $this->values()->count();
    }

    
    
}