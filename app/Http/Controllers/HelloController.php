<?php

namespace App\Http\Controllers;

use App\Facades\MyService as FacadesMyService;
use App\MyClasses\MyService;
use App\MyClasses\MyServiceInterface;
use App\MyClasses\MyServiceSet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index(Request $request, Response $response)
    {
        $msg = 'Please input text:';
        $form = [];
        if ($request->isMethod('post')) {
            $form = $request->except(['_token']);
            $msg = old('name') . ', ' . old('mail') . ', ' . old('tel');
        }
        $form['id'] = $request->query('id');
        $data = [
            'msg' => $msg,
            'form' => $form,
        ];
        $request->flash();
        return view('hello.index', $data);
    }

    public function other(Request $request)
    {
        $data = [
            'id' => '123',
            'check' => true,
        ];
        return redirect()->route('hello', $data);
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

    public function service(int $id = -1)
    {
        $myservice = app()->makeWith('App\MyClasses\MyService', ['id' => $id]);
        $data = [
            'msg' => $myservice->getMsg(),
            'data' => $myservice->getData(),
        ];
        return view('hello.simple', $data);
    }
    public function serviceSet(MyServiceInterface $myserviceset)
    {
        $data = [
            'msg' => $myserviceset->getMsg(),
            'data' => $myserviceset->getData(),
        ];
        return view('hello.simple', $data);
    }
    public function useFacade()
    {
        FacadesMyService::setId(100);
        $data = [
            'msg' => FacadesMyService::getMsg(),
            'data' => FacadesMyService::getData(),
        ];
        return view('hello.simple', $data);
    }
    public function useMid(Request $request)
    {
        $data = [
            'msg' => $request->hello,
            'data' => $request->data,
        ];
        return view('hello.simple', $data);
    }
}
