<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BehindTheScene extends Model
{
    protected $table = 'behind_the_scenes';

    protected $fillable = [
        'service_id', 'title', 'description',
        'video', 'video_url', 'image',
    
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
