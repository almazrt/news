<?php

namespace App\Modules\Article\Contracts;

use App\Modules\Article\Data\ArticleDto;
use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

interface ArticleRepositoryInterface
{
    public function create(ArticleDto $articleDto): void;

    public function getArticles(
        array $selectFields = [],
        #[ArrayShape([
            'field' => 'string',
            'direction' => 'string',
        ])]
        array $sort = []
    ): Builder;
}
