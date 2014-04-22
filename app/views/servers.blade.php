@extends('layout')

@section('content')
<h1>All Servers</h1>
<table class="table">
    <thead>
    <tr>
        <th>Server name</th>
        <th>Host name</th>
        @foreach($reportFields as $name)
        <th>{{ $name }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($servers as $server)
    <tr style="@if (! $server->reports()->count()) background: orangered; @endif">
        @if( $server->hasReports() )
            <td><i class="fa fa-thumbs-up"></i> {{ $server->name }}</td>
            <td>{{ $server->host }}</td>
            {{ $server->getLatestReport($reportType)->present()->tableRow($reportFields) }}
        @else
            <td><i class="fa fa-wheelchair"></i> {{ $server->name }}</td>
            <td>{{ $server->host }}</td>
            <td colspan="1000" style="text-align: center;">No report found</td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
@stop