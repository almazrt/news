<?php

namespace App\Modules\Article\Console\Commands;

use App\Modules\Article\Services\ArticleService;
use App\Modules\Article\Services\RbcNewsParser;
use Illuminate\Console\Command;

class ParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rbc:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(RbcNewsParser $rbcNewsParser, ArticleService $articleService)
    {
        $articleService->addArticles($rbcNewsParser->parse());

        return Command::SUCCESS;
    }
}
