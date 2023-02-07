<?php

namespace App\Modules\System\Data\Logger;

use DateTimeInterface;

class HttpLogDto
{
    public function __construct(
        public DateTimeInterface $createdAt,
        public RequestMethodEnum $requestMethodEnum,
        public string            $requestUrl,
        public int               $responseStatus,
        public string            $responseBody,
        public int               $execTimeMs,
    )
    {
    }
}
