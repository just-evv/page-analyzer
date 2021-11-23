<?php

namespace App\Http\Controllers;

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
        //$data = DB::table('urls')->get();

        return view('urls', ['data' => DB::table('urls')->paginate(15)]);
    }

    public function showOne(int $id): object
    {
        $url = DB::table('urls')
            ->where('id', '=', $id)
            ->get();

        return view('url', ['url' => $url[0]]);
    }

    public function store(Request $request): Application|RedirectResponse|Redirector
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:urls|url|max:255'
            ]
        );

        if ($validator->fails()) {
            flash('Errors')->error();
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        };

        $name = $request->input('name');
        $date = Carbon::now()->toDateTimeString();
        $id = DB::table('urls')->insertGetId(
            [
                'name' => $name,
                'created_at' => $date
            ]
        );

        return redirect()->route('urls', ['id' => $id]);
    }
}
