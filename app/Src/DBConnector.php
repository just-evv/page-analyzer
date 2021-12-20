<?php

declare(strict_types=1);

namespace App\Src;

use Carbon\CarbonImmutable;
use DiDom\Document;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Collection;

class DBConnector
{
    public function getUrlInfo(int $id): object
    {
        return DB::table('urls')->find($id);
    }

    public function getUrlChecks(int $id): object
    {
        return DB::table('url_checks')
            ->where('url_id', $id)
            ->latest()
            ->get();
    }

    public function getPaginatedUrls(): object
    {
        return DB::table('urls')->oldest()->paginate(15);
    }

    public function getUrlsLastCheck(): array
    {
        $urls = DB::table('urls')->paginate(15);
        return DB::table('url_checks')
            ->whereIn('url_id', array_column($urls->items(), 'id'))
            ->distinct()
            ->orderBy('created_at')
            ->get()
            ->keyBy('url_id')
            ->toArray();
    }

    public function findName(string $name): object|null
    {
        return DB::table('urls')->where('name', $name)->first();
    }

    public function nameInsertGetId(string $name): int
    {
        return DB::table('urls')->insertGetId(
            [
                'name' => $name
            ]
        );
    }

    public function urlCheckInsert(object $args): void
    {
        DB::table('url_checks')->insert(
            [
                'url_id' => $args->get('id'),
                'status_code' => $args->get('status_code'),
                'h1' => $args->get('h1'),
                'title' => $args->get('title'),
                'description' => $args->get('description'),
            ]
        );
    }
}
