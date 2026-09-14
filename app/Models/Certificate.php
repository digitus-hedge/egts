<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['title', 'license_type', 'description', 'image','meta_title','meta_description'];
}
