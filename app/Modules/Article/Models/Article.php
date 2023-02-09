<?php

namespace App\Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public const FIELD_TITLE = 'title';
    public const FIELD_SHORT_DESCRIPTION = 'short_description';
    public const FIELD_PUBLISHED_AT = 'published_at';
    public const FIELD_AUTHOR = 'author';
    public const FIELD_IMAGE = 'image';

    public $timestamps = false;

    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_SHORT_DESCRIPTION,
        self::FIELD_PUBLISHED_AT,
        self::FIELD_AUTHOR,
        self::FIELD_IMAGE,
    ];

    protected $casts = [
        self::FIELD_PUBLISHED_AT => 'datetime:Y-m-d',
    ];
}
