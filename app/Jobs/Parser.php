<?php

namespace App\Jobs;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Parser
{
    private $url;
    private $client;

    public function __construct($url)
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
