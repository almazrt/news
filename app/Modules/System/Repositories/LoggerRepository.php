<?php

namespace App\Modules\System\Repositories;

use App\Modules\System\Contracts\LoggerRepositoryInterface;
use App\Modules\System\Data\Logger\HttpLogDto;
use App\Modules\System\Models\Logger\HttpLog;

class LoggerRepository implements LoggerRepositoryInterface
{
    public function createHttpLog(HttpLogDto $httpLogDto): void
    {
        HttpLog::query()->create([
            'created_at' => $httpLogDto->createdAt->format('Y-m-d H:i:s'),
            'request_method' => $httpLogDto->requestMethodEnum->value,
            'request_url' => $httpLogDto->requestUrl,
            'response_status' => $httpLogDto->responseStatus,
            'response_body' => $httpLogDto->responseBody,
            'exec_time_ms' => $httpLogDto->execTimeMs,
        ]);
    }
}
