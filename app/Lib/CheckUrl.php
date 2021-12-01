<?php

namespace App\Lib;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class CheckUrl
{
    public $res;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __construct($url)
    {
        $res = new Client();
        $this->res = $res->request('GET', $url);
    }

    public function getStatusCode(): int
    {
        return $this->res->getStatusCode();
    }


}
