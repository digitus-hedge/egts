<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactBanner extends Model
{
        protected $fillable = [
        'title', 'company_name', 'description', 'image',
        'address', 'phone', 'email', 'working_hours',
        'admin_phone', 'admin_email',
        'qaqc_phone', 'qaqc_email',
        'operations_phone', 'operations_email',
        'sales_phone', 'sales_email',
    ];
}
