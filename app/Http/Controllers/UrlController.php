<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $paginatedUrls = DB::table('urls')->oldest()->paginate(15);
        $urlsLastChecks = DB::table('url_checks')
            ->whereIn('url_id', array_column($paginatedUrls->items(), 'id'))
            ->distinct()
            ->latest()
            ->get()
            ->keyBy('url_id')
            ->toArray();

        return view('urls.index', [
            'paginatedUrls' => $paginatedUrls,
            'lastChecks' => $urlsLastChecks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
            return redirect()->route('urls.show', ['url' => $url->id]);
        }

        $id = DB::table('urls')->insertGetId(['name' => $name]);

        flash('The page successfully added!')->success();
        return redirect()->route('urls.show', ['url' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(int $id): Application|Factory|View|RedirectResponse
    {
        $url = DB::table('urls')->find($id);

        if (is_null($url)) {
            flash('The url has not been found')->warning();
            return redirect()->route('index');
        }

        $checks = DB::table('url_checks')
            ->where('url_id', $id)
            ->latest()
            ->get();

        return view('urls.show', [
            'url' => $url,
            'checks' => $checks
        ]);
    }
}
