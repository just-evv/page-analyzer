<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{

    public function index()
    {
        return view('main');
    }

    public function showAll()
    {
        $data = DB::table('urls')->get();
        return view('urls', ['data' => $data]);
    }

    public function store(Request $request)
    {/*
        $name = $request->validate([
            'name' => 'required|unique:posts|max:255',
        ]);
*/
        $name = $request->input('name');
        DB::table('urls')->insert([
            'name' => $name]);
        $id = DB::table('urls')->where('name', '=', $name)->value('id');

        return redirect()->route('urls', ['id' => $id]);

    }

};
