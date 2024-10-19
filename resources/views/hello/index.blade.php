<!DOCTYPE html>
<html lang="ja">

<head>
    <title>Index</title>
</head>

<body>
    <h1>Hello/Index</h1>
    <p>{!!$msg!!}</p>
    <form action="/hello" method="post">
        @csrf
        <div>NAME: <input type="text" name="name" value="{{old('name')}}"></div>
        <div>MAIL: <input type="text" name="mail" value="{{old('mail')}}"></div>
        <div>TEL: <input type="text" name="tel" value="{{old('tel')}}"></div>
        <input type="submit">
    </form>
    <hr>
    <ol>
        @foreach($form as $key => $value)
        <li>{{$key}} : {{$value}}</li>
        @endforeach
    </ol>
</body>

</html>