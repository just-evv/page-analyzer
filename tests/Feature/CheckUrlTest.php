<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CheckUrlTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function getPathFixture(string $fixtureName): string
    {
        return realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'Fixtures', $fixtureName]));
    }

    public function testCreateCheck(): void
    {
        $urlName = "https://google.com";
        $id = DB::table('urls')->insertGetId(['name' => $urlName]);

        $testPage = (string) file_get_contents($this->getPathFixture('test.html'));

        Http::fake(function () use ($testPage) {
            return Http::response($testPage);
        });

        $response = $this->followingRedirects()->post(route('urls.checks.store', ['url' => $id]))->assertStatus(200);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', [
            'status_code' => 200,
            'h1' => 'test h1',
            'title' => 'test title',
            'description' => 'test description'
        ]);
    }
}
