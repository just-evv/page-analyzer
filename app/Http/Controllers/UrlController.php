<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data = DB::table('urls')->get();
        return view('urls', ['data' => $data]);
    }

    public function showOne(int $id): object
    {
        $url = DB::table('urls')
            ->where('id', '=', $id)
            ->get();

        return view('url', ['url' => $url]);
    }

    public function store(Request $request): object
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
};
