<?php

declare(strict_types=1);

namespace App\Src;

use Illuminate\Support\Facades\DB;

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
                'name' => $name
            ]
        );
    }

    public function getUrlName(int $id): string
    {
        return DB::table('urls')->where('id', $id)->value('name');
    }

    /**
     * @throws \DiDom\Exceptions\InvalidSelectorException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function urlCheckInsert(int $id, Parser $check): void
    {
        DB::table('url_checks')->insert(
            [
                'url_id' => $id,
                'status_code' => $check->getStatusCode(),
                'h1' => $check->getH1(),
                'title' => $check->getTitle(),
                'description' => $check->getDescription()
            ]
        );
    }
}
