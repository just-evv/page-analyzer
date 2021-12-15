<?php

declare(strict_types=1);

namespace App\Src;

use Carbon\CarbonImmutable;
use DiDom\Document;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
            ->get();
    }

    public function getUrlsList(): object
    {
        return DB::table('urls')
            ->select(
                'urls.id',
                'urls.name',
                DB::raw('MAX(url_checks.status_code) as status_code'),
                DB::raw('MAX(url_checks.created_at) as last_check')
            )
            ->leftJoin('url_checks', 'urls.id', '=', 'url_checks.url_id')
            ->groupBy('urls.id')
            ->orderBy('urls.id', 'asc')
            ->paginate(15);
    }

    public function findName(string $name): object|null
    {
        return DB::table('urls')->where('name', $name)->first();
    }

    public function nameInsertGetId(string $name): int
    {
        return DB::table('urls')->insertGetId(
            [
                'name' => $name,
            ]
        );
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws ConnectionException
     */
    public function urlCheck(int $id): void
    {
        $url = DB::table('urls')->where('id', $id)->value('name');

        if (HTTP::get($url)->serverError()) {
            throw new ConnectionException();
        }

        $response = HTTP::get($url);
        $document = new Document($response->body());
        $status = $response->status();
        $h1 = optional($document->first('h1'))->text();
        $title = optional($document->first('title'))->text();
        $description = optional($document->first('meta[name=description]'))->getAttribute('content');

        DB::table('url_checks')->insert(
            [
                'url_id' => $id,
                'status_code' => $status,
                'h1' => $h1,
                'title' => $title,
                'description' => $description,
            ]
        );
    }
}
