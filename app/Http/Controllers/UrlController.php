<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\Parser;
use App\Jobs\DBConnector;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
                'name' => 'required|url|max:255'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = $request->input('url.name');

        $parsedUrl = parse_url($name);
        $host = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        $dbConnection = new DBConnector();

        $url = $dbConnection->findName($host);

        if (!is_null($url)) {
            flash('The page already exists!')->success();
            return redirect()->route('urls.show', ['id' => $url->id]);
        }
        $id = $dbConnection->nameInsertGetId($host);

        flash('The page successfully added!')->success()->important();
        return redirect()->route('urls.show', ['id' => $id]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */

    public function checkUrl(int $id): object
    {
        $dbConnection = new DBConnector();

        $check = new Parser($dbConnection->getUrlName($id));

        try {
            $statusCode = $check->getStatusCode();
        } catch (GuzzleException $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        $dbConnection->urlCheckInsert(
            $id,
            $statusCode,
            $check->getH1(),
            $check->getTitle(),
            $check->getDescription()
        );

        flash('The page successfully checked!')->success()->important();

        return redirect()->route('urls.show', ['id' => $id]);
    }
}
