<?php

namespace App\Http\Controllers\Sample;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'msg' => config('sample.message'),
            'data' => config('sample.data'),
        ];
        return view('hello.index', $data);
    }

    public function other(Request $request)
    {
        $data = [
            'msg' => 'SAMPLE-OTHER',
        ];
        return view('hello.index', $data);
    }
}
