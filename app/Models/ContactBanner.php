<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactBanner extends Model
{
    protected $fillable = [
        'title', 'description', 'image',
        'address', 'phone', 'email', 'working_hours',
    ];
}
