<?php

declare(strict_types=1);

namespace App\Src;

use GuzzleHttp\Exception\GuzzleException;
use DiDom\Document;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class Parser
{
    public object $response;

    /**
     * @throws ConnectionException
     */
    public function __construct(string $url)
    {
        if (HTTP::get($url)->serverError()) {
            throw new ConnectionException();
        }
        $this->response = HTTP::get($url);
    }

    public function getStatusCode(): int
    {
        return $this->response->status();
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    private function getResponseBody(): object
    {
        return new Document($this->response->body());
    }

    /**
     * @throws GuzzleException
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function getH1(): string|null
    {
        return optional($this->getResponseBody()->first('h1'))->text();
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    public function getTitle(): string|null
    {
        return optional($this->getResponseBody()->first('title'))->text();
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    public function getDescription(): string|null
    {
        return optional($this->getResponseBody()->first('meta[name=description]'))->getAttribute('content');
    }

}
