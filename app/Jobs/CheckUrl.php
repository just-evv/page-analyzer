<?php

namespace App\Jobs;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CheckUrl
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
    public function getStatusCode()
    {
        $response = $this->client->request('GET', $this->url);

        return $response->getStatusCode();

    }

}
