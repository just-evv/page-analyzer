<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('index'));
        $response->assertOk();
    }

    public function testUrlsAll()
    {
        $response = $this->get(route('urls.all'));
        $response->assertOk();
    }

    public function testUrlStore()
    {
        $domainName = "https://google.com";
        $id = DB::table('urls')->insertGetId([
            'name' => $domainName,
        ]);
        $response = $this
            ->post(route('urls.store'), ['url' => ['name' => $domainName]])
            ->assertRedirect(route('urls.show', ['id' => $id]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseCount('urls', 1);
    }

    public function testCreateCheck(): void
    {
        $domainName = "https://google.com";
        $id = DB::table('urls')->insertGetId([
            'name' => $domainName,
        ]);

        $testPage = file_get_contents(__DIR__ . '/../fixtures/test.html');

        Http::fake(Http::response($testPage));
        

        $response = $this
            ->followingRedirects()
            ->post(route('checks.store', ['id' => $id]))
            ->assertStatus(200);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('url_checks', [
            'status_code' => 200,
            'h1' => 'test h1',
            'title' => 'test title',
            'description' => 'test description',
        ]);
    }




}
