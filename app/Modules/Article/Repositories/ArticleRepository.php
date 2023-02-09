<?php

namespace App\Modules\Article\Repositories;

use App\Modules\Article\Contracts\ArticleRepositoryInterface;
use App\Modules\Article\Data\ArticleDto;
use App\Modules\Article\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

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

    public function getArticles(
        array $selectFields = ['*'],
        #[ArrayShape([
            'field' => 'string',
            'direction' => 'string',
        ])]
        array $sort = []
    ): Builder
    {
        $result = Article::query()->select($selectFields);

        foreach ($sort as $sortFields) {
            $result->orderBy($sortFields['field'], $sortFields['direction']);
        }

        return $result;
    }
}
