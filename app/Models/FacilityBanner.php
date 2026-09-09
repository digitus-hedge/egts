<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacilityBanner extends Model
{
    protected $fillable = [
        'banner_image', 'banner_title', 'banner_description',
        'operations_heading', 'operations_description',
        'infrastructure_title', 'infrastructure_description',
    ];
}
