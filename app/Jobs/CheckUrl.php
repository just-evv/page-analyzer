<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class CheckUrl
{
    private $url;
    private $client;

    public function __construct($url)
    {
        $this->client = new Client();
        $this->url = $url;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatusCode(): int
    {
        $response = $this->client->request('GET', $this->url);
        return $response->getStatusCode();
    }


}
