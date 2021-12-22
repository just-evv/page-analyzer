<?php

namespace Tests\Feature;

use Tests\TestCase;

class UrlsShowTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }

    public function testUrlsAll()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }
}
