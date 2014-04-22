@extends('layout')

@section('content')
<h1>{{ $reports->first()->present()->reportType->name }}</h1>

<table class="table">
    <thead>
    <tr>
        {{ $reports->first()->present()->tableHeadRow }}
    </tr>
    </thead>
    <tbody>
    @foreach($reports as $report)
    <tr>
        {{ $report->present()->tableRow }}
    </tr>
    @endforeach
    </tbody>
</table>
@stop