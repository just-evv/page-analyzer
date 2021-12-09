<?php

declare(strict_types=1);

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DiDom\Document;
use Illuminate\Support\Facades\Http;

class Parser
{
    private $response;

    public function __construct(string $url)
    {
        $this->response = HTTP::get($url);
    }

    /**
     * @throws GuzzleException
     */
    public function getStatusCode(): int
    {
        return $this->response->status();
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    public function getDiDomTree(): object
    {
        return new Document($this->response->body());
    }

    /**
     * @throws GuzzleException
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function getH1(): string|null
    {
        if (count($elements = $this->getDiDomTree()->find('h1')) > 0) {
            return $elements[0]->text();
        }
        return null;
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    public function getTitle(): string|null
    {

        if (count($elements = $this->getDiDomTree()->find('title')) > 0) {
            return $elements[0]->text();
        }
        return null;
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws GuzzleException
     */
    public function getDescription(): string|null
    {
        if (count($elements = $this->getDiDomTree()->find('meta[name=description]')) > 0) {
            return $elements[0]->getAttribute('content');
        }
        return null;
    }
}
