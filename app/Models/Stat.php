<?php
// app/Models/Stat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'value',
        'label',
        'description',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Only active stats, ordered for frontend display
    public function scopeActive($query)
    {
        return $query->where('status', 1)->orderBy('sort_order');
    }
}
