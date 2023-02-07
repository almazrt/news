<?php

namespace App\Modules\Article\Services;


use App\Modules\Article\Contracts\ParserInterface;
use App\Modules\Article\Data\ArticleDto;
use Carbon\Carbon;
use Exception;
use Illuminate\Config\Repository;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use SimpleXMLElement;

class RbcNewsParser implements ParserInterface
{
    public function __construct(
        private Repository       $config,
        private ClientInterface  $client,
        private RequestInterface $request,
        private UriInterface     $uri,
    )
    {
    }

    /**
     * @return array<ArticleDto>
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function parse(): array
    {
        $newsXml = new SimpleXMLElement($this->loadData());
        $newsDto = [];

        foreach ($newsXml->channel->item as $item) {
            $newsDto[] = new ArticleDto(
                $item->title,
                $item->description,
                Carbon::parse($item->pubDate),
                $item->author ?? null,
                $item->enclosure['url'] ?? null,
            );
        }

        return $newsDto;
    }

    /**
     * @throws ClientExceptionInterface
     */
    public function loadData(): string
    {
        return (string)$this->client->sendRequest(
            $this->request->withUri(
                $this->uri->withHost($this->config->get('parsers.rbc.feed_url'))
                    ->withPath($this->config->get('parsers.rbc.news_feed_path'))
            )
                ->withMethod('GET')
        )->getBody();
    }
}
