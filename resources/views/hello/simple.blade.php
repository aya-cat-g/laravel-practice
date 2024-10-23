<!DOCTYPE html>
<html lang="ja">

<head>
    <title>Simple</title>
</head>

<body>
    <h1>Hello/Simple</h1>
    <p>{!!$msg!!}</p>
    <ul>
        @foreach($data as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</body>

</html>