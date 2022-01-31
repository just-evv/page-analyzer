<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlCheckTest extends TestCase
{
    private int $id;

    public function setUp(): void
    {
        parent::setUp();
        $this->id = DB::table('urls')->insertGetId(['name' => 'https://google.com']);
    }

    public function getFixturePath(string $fixtureName): string
    {
        return realpath(implode(DIRECTORY_SEPARATOR, [__DIR__, '..', 'Fixtures', $fixtureName]));
    }

    public function testCreateCheck(): void
    {
        $testPage = (string) file_get_contents($this->getFixturePath('test.html'));

        Http::fake(function () use ($testPage) {
            return Http::response($testPage);
        });

        $expectedResult = [
            'status_code' => 200,
            'h1' => 'test h1',
            'title' => 'test title',
            'description' => 'test description'
        ];

        $response = $this->followingRedirects()
            ->post(route('urls.checks.store', ['url' => $this->id]))
            ->assertStatus(200)
            ->assertSee($expectedResult);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', $expectedResult);
    }
}
