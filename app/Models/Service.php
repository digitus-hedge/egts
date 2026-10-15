<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'process_description',
        'technical_scope',
        'specifications',
        'image',
        'gallery',
        'inspection_process',
        'show_on_home'
    ];

    protected $casts = [
        'technical_scope' => 'array',
        'specifications'  => 'array',
        'gallery'         => 'array',
        'inspection_process' => 'array',
        'show_on_home' => 'boolean',
    ];
}
