<?php

namespace App\Modules\Article\Services;

use App\Modules\Article\Contracts\ArticleRepositoryInterface;
use App\Modules\Article\Data\ArticleDto;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class ArticleService
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        private Filesystem                 $filesystem,
    )
    {
    }

    /**
     * @param array<string> $selectFields
     */
    public function getArticles(
        int   $page,
        array $selectFields = [],
        #[ArrayShape([
            'field' => 'string',
            'direction' => 'string',
        ])]
        array $sort = []
    ): LengthAwarePaginator
    {
        return $this->articleRepository->getArticles($selectFields, $sort)->paginate(page: $page);
    }

    /**
     * @param array<ArticleDto> $articlesDto
     */
    public function addArticles(array $articlesDto): void
    {
        foreach ($articlesDto as $articleDto) {
            $this->addArticle($articleDto);
        }
    }

    public function addArticle(ArticleDto $articleDto): void
    {
        $this->articleRepository->create(
            $articleDto->image ? $this->downloadImage($articleDto) : $articleDto
        );
    }

    public function downloadImage(ArticleDto $articleDto): ArticleDto
    {
        $ext = pathinfo($articleDto->image, PATHINFO_EXTENSION);
        $filename = Str::random(30) . '.' . $ext;
        $dir = storage_path('app/articles/');
        if (!$this->filesystem->isDirectory($dir)) {
            $this->filesystem->makeDirectory($dir);
        }
        $this->filesystem->put($dir . $filename, file_get_contents($articleDto->image));
        return new ArticleDto(
            $articleDto->title,
            $articleDto->shortDescription,
            $articleDto->publishedAt,
            $articleDto->author,
            $filename,
        );
    }
}
