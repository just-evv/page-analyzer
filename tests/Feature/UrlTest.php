<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlTest extends TestCase
{
    private int $id;
    private array $domain;

    public function setUp(): void
    {
        parent::setUp();
        $this->domain = ['name' => 'https://google.com'];
        $this->id = DB::table('urls')->insertGetId($this->domain);
    }

    public function testUrlStore(): void
    {
        $this->followingRedirects()
            ->post(route('urls.store'), ['url' => $this->domain])
            ->assertOk()
            ->assertSee($this->domain['name']);
        $this->assertDatabaseCount('urls', 1);
        $this->assertDatabaseHas('urls', ['name' => 'https://google.com']);
    }

    public function testUrlIndex(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testUrlShow(): void
    {
        $this->get(route('urls.show', ['url' => $this->id]))
            ->assertOk()
            ->assertSee($this->domain['name']);
    }

    public function testUrlShowNotExistingId()
    {
        $this->get(route('urls.show', ['url' => PHP_INT_MAX]))
            ->assertNotFound();
    }
}
