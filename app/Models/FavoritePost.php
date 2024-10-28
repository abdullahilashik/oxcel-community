<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoritePost extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function favoriteByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_posts', 'post_id', 'user_id');
    }
}
