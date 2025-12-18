<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'order',
        'images'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
