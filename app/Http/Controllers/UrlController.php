<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function index(): object
    {
        return view('main');
    }

    public function showAll(): object
    {
        $paginatedUrls = DB::table('urls')->oldest()->paginate(15);
        $urlsLastChecks = DB::table('url_checks')
            ->whereIn('url_id', array_column($paginatedUrls->items(), 'id'))
            ->distinct()
            ->orderBy('created_at')
            ->get()
            ->keyBy('url_id')
            ->toArray();

        return view('urls', [
            'paginatedUrls' => $paginatedUrls,
            'lastChecks' => $urlsLastChecks
        ]);
    }

    public function showOne(int $id): object
    {
        $url = DB::table('urls')->find($id);
        $checks = DB::table('url_checks')
            ->where('url_id', $id)
            ->latest()
            ->get();

        return view('url', [
            'url' => $url,
            'checks' => $checks
        ]);
    }

    public function store(Request $request): object
    {
        $validator = Validator::make(
            $request->input('url'),
            [
                'name' => 'required|url|max:255'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $parsedUrl = parse_url($request->input('url.name'));
        $name = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        $url = DB::table('urls')->where('name', $name)->first();

        if (!is_null($url)) {
            flash('The page already exists!')->success();
            return redirect()->route('urls.show', ['id' => $url->id]);
        }

        $id = DB::table('urls')->insertGetId(['name' => $name]);

        flash('The page successfully added!')->success();
        return redirect()->route('urls.show', ['id' => $id]);
    }

    /**
     * @throws InvalidSelectorException
     * @throws GuzzleException
     * @throws ConnectionException
     */
    public function checkUrl(int $id): object
    {
        $urlName = DB::table('urls')->find($id)->name;

        try {
            $response = HTTP::get($urlName);
            if ($response->serverError()) {
                throw new ConnectionException();
            }
        } catch (ConnectionException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        if ($response->body() == '') {
            flash('The requested page is empty!')->warning();
            return back();
        }

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
                'description' => $description
            ]
        );

        flash('The page successfully checked!')->success();

        return redirect()->route('urls.show', ['id' => $id]);
    }
}
