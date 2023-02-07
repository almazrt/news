<?php

namespace App\Modules\Article\Repositories;

use App\Modules\Article\Contracts\ArticleRepositoryInterface;
use App\Modules\Article\Data\ArticleDto;
use App\Modules\Article\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function create(ArticleDto $articleDto): void
    {
        Article::query()->create([
            'title' => $articleDto->title,
            'short_description' => $articleDto->shortDescription,
            'published_at' => $articleDto->publishedAt->format('Y-m-d H:i:s'),
            'author' => $articleDto->author,
            'image' => $articleDto->image,
        ]);
    }
}
