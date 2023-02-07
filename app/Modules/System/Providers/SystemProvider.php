<?php

namespace App\Modules\System\Providers;

use App\Modules\System\Client\ClientFactory;
use App\Modules\System\Contracts\LoggerRepositoryInterface;
use App\Modules\System\Repositories\LoggerRepository;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class SystemProvider extends ServiceProvider
{
    /**
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->bind(LoggerRepositoryInterface::class, LoggerRepository::class);

        /** @var ClientFactory $clientFactory */
        $clientFactory = $this->app->make(ClientFactory::class);

        $this->app->instance(ClientInterface::class, $clientFactory->make(config('http.client.mock_enable'), config('http.client.log_enable')));

        $this->app->bind(RequestInterface::class, function () {
            return new Request('get', 'https://example.com');
        });

        $this->app->bind(UriInterface::class, Uri::class);
    }
}
