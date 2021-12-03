<?php

namespace App\Http\Controllers;

use App\Jobs\CheckUrl;
use App\Jobs\DBConnector;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{

    public function index(): object
    {
        return view('main');
    }

    public function showAll(): object
    {
        $dbConnection = new DBConnector();

        return view('urls', [
            'data' => $dbConnection->getUrlsList()
        ]);
    }

    public function showOne(int $id): object
    {
        $dbConnection = new DBConnector();

        return view('url', [
            'url' => $dbConnection->getUrlInfo($id),
            'checks' => $dbConnection->getUrlChecks($id)
        ]);
    }

    public function store(Request $request): object
    {
        $validator = Validator::make(
            $request->input('url'),
            [
                'name' => 'required|unique:urls|url|max:255'
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('index')
                ->withErrors($validator)
                ->withInput();
        };

        $name = $request->input('url.name');
        $dbConnection = new DBConnector();
        $id = $dbConnection->nameInsertGetId($name);

        flash('The page successfully added!')->success()->important();
        return redirect()->route('urls.show', ['id' => $id]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function checkUrl($id): object
    {
        $dbConnection = new DBConnector();

        $check = new CheckUrl($dbConnection->getUrlName($id));

        $dbConnection->urlCheckInsert($id, $check);

        flash('The page successfully checked!')->success()->important();

        return redirect()->route('urls.show', ['id' => $id]);
    }
}
