<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HelloController extends Controller
{
    private $fname;
    private $pname;
    function __construct()
    {
        $this->fname = 'sample.txt';
        $this->pname = 'hello.txt';
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

    public function get()
    {
        $data = [
            'msg' => $this->fname,
            'data' => explode(PHP_EOL, Storage::get($this->fname))
        ];
        return view('hello.index', $data);
    }

    public function put($msg)
    {
        Storage::append($this->fname, $msg);
        return redirect()->route('hello.get');
    }

    // publicディスクの操作
    public function getPublic()
    {
        $data = [
            'url' => Storage::disk('public')->url($this->pname),
            'size' => Storage::disk('public')->size($this->pname),
            'modified_time' => date('y-m-d H:i:s', Storage::disk('public')->lastModified($this->pname)),
            'data' => explode(PHP_EOL, Storage::disk('public')->get($this->pname)),
            'fileList' => Storage::disk('logs')->allFiles('/'),
        ];
        return view('hello.fileinfo', $data);
    }

    public function putPublic($msg)
    {
        Storage::disk('public')->prepend($this->pname, $msg);
        // ローカルにコピー
        if (Storage::disk('local')->exists('bk_' . $this->pname)) {
            Storage::disk('local')->delete('bk_' . $this->pname);
        }
        Storage::disk('local')->put('bk_' . $this->pname, Storage::disk('public')->get($this->pname));
        return redirect()->route('hello.getPub');
    }

    public function download()
    {
        return Storage::disk('public')->download($this->pname);
    }

    public function upload(Request $request)
    {
        // ローカルにランダムなファイル名で保存
        Storage::disk('local')->putFile('files', $request->file('file'));
        // publicに uploaded.拡張子 の名前で保存
        $filename = "uploaded.{$request->file('file')->extension()}";
        Storage::disk('public')->putFileAs('files', $request->file('file'), $filename);
        return redirect()->route('hello.getPub');
    }
}
