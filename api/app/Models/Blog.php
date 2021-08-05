<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $collection = 'blogs';
    /**
     * user_id,
     * title,
     * description
     * body,
     * slug,
     * meta_tags: {
     *   meta_title,
     *   meta_description,
     *   meta_image,
     * },
     * category_ids: []
     * created_at,
     * updated_at
     */
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, null, 'blog_ids', 'category_ids');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
