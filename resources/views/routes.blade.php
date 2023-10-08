<!DOCTYPE html>
<html>
<head>
    <title>Daftar Rute</title>
</head>
<body>
    <h1>Daftar Rute</h1>
    
    <table>
        <thead>
            <tr>
                <th>Method</th>
                <th>URI</th>
                <th>Action</th>
            </tr>
        </thead>
        {{$id=1}}
        <tbody>
            @foreach ($routeCollection as $route)
                <tr>
                    <td>{{$id++}}</td>
                    <td>{{ implode('|', $route->methods()) }}</td>
                    <td>{{ $route->uri() }}</td>
                    <td>{{ $route->getActionName() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
