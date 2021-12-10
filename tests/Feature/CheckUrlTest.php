<?php

namespace Tests\Feature;

use App\Src\DBConnector;
use Carbon\CarbonImmutable;
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
        $domainName = "https://google.com";
        $dbConnector = new DBConnector();
        $id = $dbConnector->nameInsertGetId($domainName);

        $testPage = file_get_contents($this->getPathFixture('test.html'));

        Http::fake(function() use ($testPage) {
            return Http::response($testPage);
        });

        $response = $this->followingRedirects()->post(route('checks.store', ['id' => $id]))->assertStatus(200);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('url_checks', [
            'status_code' => 200,
            'h1' => 'test h1',
            'title' => 'test title',
            'description' => 'test description'
        ]);
    }
}
