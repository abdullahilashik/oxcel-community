<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PostCategoryRel extends Model
{
    use Searchable;
    protected $fillable = [
        'post_id',
        'post_category_id'
    ];
}
