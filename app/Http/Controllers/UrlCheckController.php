<?php

namespace App\Http\Controllers;

use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  int $id
     * @return RedirectResponse
     * @throws InvalidSelectorException
     * @throws GuzzleException
     * @throws ConnectionException
     */
    public function store(int $id): RedirectResponse
    {
        $urlName = DB::table('urls')->find($id)->name;

        try {
            $response = HTTP::get($urlName);
            if ($response->serverError()) {
                throw new ConnectionException();
            } elseif ($response->body() == '') {
                flash('The requested page is empty!')->warning();
                return back();
            }
        } catch (ConnectionException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
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
        return redirect()->route('urls.show', ['url' => $id]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
    }
}
