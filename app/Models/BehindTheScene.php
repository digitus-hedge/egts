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

    public function getEmbedUrlAttribute(): ?string
    {
        if (!$this->video_url) {
            return null;
        }

        $url = $this->video_url;

        // youtube.com/shorts/VIDEO_ID
        if (preg_match('/shorts\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // youtube.com/watch?v=VIDEO_ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }

}
