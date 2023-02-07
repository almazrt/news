<?php

namespace App\Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'short_description',
        'published_at',
        'author',
        'image',
    ];

    public $timestamps = false;
}
