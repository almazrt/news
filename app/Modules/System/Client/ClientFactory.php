<?php

namespace App\Modules\System\Client;

use App\Modules\System\Contracts\LoggerRepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Psr\Http\Client\ClientInterface;

readonly class ClientFactory
{
    public function __construct(private Container $container)
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function make(bool $mock = false, bool $log = true): ClientInterface
    {
        $client = match ($mock) {
            true => $this->container->make(MockClient::class),
            false => $this->container->make(Client::class),
        };

        return $log ? $this->makeLoggerClient($client) : $client;
    }

    /**
     * @throws BindingResolutionException
     */
    private function makeLoggerClient(ClientInterface $client): ClientInterface
    {
        return new LoggerClient($client, $this->container->make(LoggerRepositoryInterface::class));
    }
}
