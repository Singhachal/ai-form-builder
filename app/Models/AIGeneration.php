<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AIGeneration extends Model
{
    protected $table = 'ai_generations';
    protected $fillable = [
        'prompt',
        'form_id',
        'response',
    ];

    protected $casts = [
        'response' => 'array',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}