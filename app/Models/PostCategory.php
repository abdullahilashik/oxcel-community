<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PostCategory extends Model
{
    use Searchable;
    protected $fillable = [
        'title',
        'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'post_category_rels', 'post_category_id', 'post_id');
    }
}
