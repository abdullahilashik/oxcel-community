<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostBookmark extends Model
{
    protected $fillable = [
        'post_id',
        'user_id'
    ];

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_bookmarks', 'post_id', 'user_id');
    }
}
