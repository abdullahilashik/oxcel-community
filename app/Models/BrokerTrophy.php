<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrokerTrophy extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'threshold'
    ];
}
