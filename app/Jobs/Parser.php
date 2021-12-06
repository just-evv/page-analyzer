<?php

declare(strict_types=1);

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DiDom\Document;

class Parser
{
    private $url;
    private $client;
    private $document;

    public function __construct(string $url)
    {
        $this->client = new Client(['http_errors' => false]);
        $this->document = new Document();
        $this->url = $url;
    }

    /**
     * @throws GuzzleException
     */
    public function getStatusCode(): int
    {
        $response = $this->client->request('GET', $this->url);

        return $response->getStatusCode();
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function getH1(): string|null
    {
        $this->document->loadHtmlFile($this->url);

        if ($this->document->has('h1')) {
            return $this->document->find('h1')[0]->text();
        }
        return null;
        
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function getTitle(): string|null
    {
        $this->document->loadHtmlFile($this->url);

        if ($this->document->has('title')) {
            return $this->document->find('title')[0]->text();
        }
        return null;
    }


}
