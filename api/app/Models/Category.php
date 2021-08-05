<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * user_id,
     * name,
     * slug,
     * blog_ids: []
     */

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, null, 'category_ids', 'blog_ids');
    }
}
