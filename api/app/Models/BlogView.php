<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    protected $collection = 'blog_views';
    protected $guarded = [];
    /**
     *  ip,
     * 'device',
     * 'platform',
     * 'browser',
     * 'robot' 
     */

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
