<!DOCTYPE html>
<html lang="ja">

<head>
    <title>FileInfo</title>
    <style>
        table {
            margin-bottom: 10px;
        }

        th {
            background-color: gray;
            padding: 10px;
            color: white;
        }

        td {
            background-color: #eee;
            padding: 10px;
        }
    </style>
</head>



<body>
    <h1>Hello/FileInfo</h1>
    <table>
        <tr>
            <th>url</th>
            <th>size</th>
            <th>modified</th>
        </tr>
        <tr>
            <td>{{$url}}</td>
            <td>{{$size}}</td>
            <td>{{$modified_time}}</td>
        </tr>
    </table>
    @foreach($data as $item)
    <li>{{$item}}</li>
    @endforeach

    <p><a href="/hello/download">download</a></p>
    <form action="/hello/upload" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <input type="submit">
    </form>

    @foreach($fileList as $file)
    <li>{{$file}}</li>
    @endforeach

</body>

</html>