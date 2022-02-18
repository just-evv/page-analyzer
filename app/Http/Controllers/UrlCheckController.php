<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use Error;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PHPUnit\Exception;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @return RedirectResponse
     * @throws InvalidSelectorException
     * @throws ConnectionException
     */
    public function store(int $id): RedirectResponse
    {
        $url = DB::table('urls')->find($id);

        abort_if(is_null($url), 404, 'The page has not been found');

        try {
            $response = HTTP::get($url->name);
        } catch (HttpClientException | RequestException $exception) {
            flash($exception->getMessage())->error();
            return back();
        }

        try {
            $document = new Document($response->body());
        } catch (Exception | Error $e) {
            $document = new Document();
        }

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
                'description' => $description
            ]
        );
        flash('The page successfully checked!')->success();
        return redirect()->route('urls.show', ['url' => $id]);
    }
}
