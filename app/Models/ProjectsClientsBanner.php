<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectsClientsBanner extends Model
{
    protected $fillable = [
        'image', 'title', 'content', 'description',
    ];
}
