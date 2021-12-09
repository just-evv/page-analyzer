<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlsStoreTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

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
}
