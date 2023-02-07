<?php

namespace App\Modules\System\Contracts;

use App\Modules\System\Data\Logger\HttpLogDto;

interface LoggerRepositoryInterface
{
    public function createHttpLog(HttpLogDto $httpLogDto): void;
}
