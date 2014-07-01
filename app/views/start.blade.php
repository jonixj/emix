<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EMiX</title>
</head>
<body>
<h1>Detta är nya EMiX</h1>

<table>
    <thead>
    <th><h3>Nod: {{ $node->name }}</h3></th>
    </thead>
    <thead>
    <th>namn</th>
    <th>current load</th>
    </thead>
    <tbody>
    <tr>
        <td>{{ $node->name }}</td>
        <td>{{ implode(', ',$node->getLatestReportByCommandName('load')['load']) }}</td>
    </tr>
    </tbody>
</table>

<table>
    <thead>
        <th>ctid</th>
        <th>host</th>
        <th>os</th>
        <th>status</th>
        <th>current load</th>
    </thead>
    <tbody>
    @foreach($node->containers as $container)
    <tr>
        <td>{{ $container->ctid }}</td>
        <td>{{ $container->host }}</td>
        <td>{{ $container->os }}</td>
        <td>{{ $container->status }}</td>
        <td>{{ implode(', ',$container->getLatestReportByCommandName('load')['load']) }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>