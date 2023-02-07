<?php

namespace App\Modules\Article\Providers;

use App\Modules\Article\Contracts\ArticleRepositoryInterface;
use App\Modules\Article\Repositories\ArticleRepository;
use Illuminate\Support\ServiceProvider;

class ArticleProvider extends ServiceProvider
{
    public $bindings = [
        ArticleRepositoryInterface::class => ArticleRepository::class
    ];
}
