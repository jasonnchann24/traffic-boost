<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

// use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $collection = 'roles';
    protected $fillable = [
        'name',
        'slug'
    ];

    protected $hidden = [
        'id'
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
