<?php

declare(strict_types=1);

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Parser
{
    private $url;
    private $client;

    public function __construct(string $url)
    {
        $this->client = new Client(['http_errors' => false]);
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
}
