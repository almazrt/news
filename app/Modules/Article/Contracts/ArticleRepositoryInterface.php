<?php

namespace App\Modules\Article\Contracts;

use App\Modules\Article\Data\ArticleDto;

interface ArticleRepositoryInterface
{
    public function create(ArticleDto $articleDto): void;
}
