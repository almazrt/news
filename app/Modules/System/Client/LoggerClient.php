<?php

namespace App\Modules\System\Client;

use App\Modules\System\Contracts\LoggerRepositoryInterface;
use App\Modules\System\Data\Logger\HttpLogDto;
use App\Modules\System\Data\Logger\RequestMethodEnum;
use Carbon\Carbon;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class LoggerClient implements ClientInterface
{
    public function __construct(
        private readonly ClientInterface           $decorableCLient,
        private readonly LoggerRepositoryInterface $loggerRepository,
    )
    {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws Throwable
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $date = Carbon::now();
        try {
            $response = $this->decorableCLient->sendRequest($request);

            $dto = new HttpLogDto(
                Carbon::now(),
                RequestMethodEnum::from($request->getMethod()),
                $request->getUri(),
                $response->getStatusCode(),
                $response->getBody()->getContents(),
                Carbon::now()->diffInMicroseconds($date),
            );
            $this->loggerRepository->createHttpLog($dto);
        } catch (Throwable $e) {
            $dto = new HttpLogDto(
                Carbon::now(),
                RequestMethodEnum::from($request->getMethod()),
                $request->getUri(),
                $e->getCode(),
                $e->getMessage(),
                Carbon::now()->diffInMicroseconds($date),
            );
            $this->loggerRepository->createHttpLog($dto);

            throw $e;
        }

        return $response;
    }
}
