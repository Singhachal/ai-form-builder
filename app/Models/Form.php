<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'schema',
        'is_active',
        'is_public'
    ];

    protected $casts = [
        'schema' => 'array',
        'is_active' => 'boolean',
        'is_public' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($form) {

            if (empty($form->slug)) {

                $form->slug = Str::slug($form->title) . '-' . uniqid();

            }

        });

    }

    public function fields()
    {
        return $this->hasMany(FormField::class)
            ->orderBy('sort_order');
    }

    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function getPublicUrlAttribute()
    {
        return url('/forms/' . $this->slug);
    }

    public function getTotalFieldsAttribute()
    {
        return $this->fields()->count();
    }

    public function getTotalSubmissionsAttribute()
    {
        return $this->submissions()->count();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}