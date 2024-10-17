<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    function __construct()
    {
        config(['sample.message' => '書き換え']);
    }
    public function index()
    {

        $data = [
            'msg' => config('sample.message'),
            'data' => config('sample.data'),
        ];

        return view('hello.index', $data);
    }

    public function other(Request $request)
    {
        return redirect()->route('sample');
    }
}
