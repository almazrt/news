<?php

namespace App\Modules\Article\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Article\Http\Requests\ShowArticlesRequest;
use App\Modules\Article\Http\Resources\ArticleResource;
use App\Modules\Article\Services\ArticleService;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function __construct(
        private ArticleService $articleService
    )
    {
    }

    public function index(ShowArticlesRequest $request): JsonResource
    {
        $articles = $this->articleService->getArticles(
            $request->get('page', 1),
            $request->get('select_fields', ['*']),
            $request->get('sort', []),
        );

        return ArticleResource::collection($articles);
    }
}
