<?php

namespace App\Modules\Article\Data;

use DateTimeInterface;

readonly class ArticleDto
{
    public function __construct(
        public string            $title,
        public string            $shortDescription,
        public DateTimeInterface $publishedAt,
        public string|null       $author = null,
        public string|null       $image = null,
    )
    {
    }
}
