<?php

namespace App\Modules\System\Client;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class MockClient implements ClientInterface
{
    public function __construct(private readonly Container $container)
    {
    }

    /**
     * @throws BindingResolutionException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->container->make(ResponseInterface::class);
    }
}
