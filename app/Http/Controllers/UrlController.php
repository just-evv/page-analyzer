<?php

namespace App\Http\Controllers;

use App\Lib\CheckUrl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{

    public function index(): object
    {

        return view('main');
    }

    public function showAll(): object
    {
        $data = DB::table('urls')
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

        return view('urls', [
            'data' => $data
        ]);
    }

    public function showOne(int $id): object
    {
        $url = DB::table('urls')->find($id);

        $checks = DB::table('url_checks')
            ->where('url_id', $id)
            ->get();

        return view('url', ['url' => $url, 'checks' => $checks]);
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

        $id = DB::table('urls')->insertGetId(
            [
                'name' => $name
            ]
        );
        flash('The page successfully added!')->success()->important();
        return redirect()->route('urls.show', ['id' => $id]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkUrl($id): object
    {
        $url = DB::table('urls')->where('id', $id)->value('name');

        $check = new CheckUrl($url);

        DB::table('url_checks')->insert(
            [
                'url_id' => $id,
                'status_code' => $check->getStatusCode()
            ]
        );

        flash('The page successfully checked!')->success()->important();

        return redirect()->route('urls.show', ['id' => $id]);
    }
}
