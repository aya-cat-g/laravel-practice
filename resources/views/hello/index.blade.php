<!DOCTYPE html>
<html lang="ja">

<head>
    <title>Index</title>
</head>

<body>
    <h1>Hello/Index</h1>
    <p>{{$msg}}</p>
    @foreach($data as $item)
    <li>{{$item}}</li>
    @endforeach
</body>

</html>