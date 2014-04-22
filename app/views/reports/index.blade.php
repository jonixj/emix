@extends('layout')

@section('content')
<h1>All reports</h1>
@foreach($reportTypes as $reportType)
    @if($reportType->reports->first())
    <h3>{{ $reportType->reports->first()->present()->reportType->name }}</h3>
    <table class="table">
        <thead>
        <tr>
            {{ $reportType->reports()->first()->present()->tableHeadRow }}
        </tr>
        </thead>
        <tbody>
        @foreach($reportType->reports as $report)
        <tr>
            {{ $report->present()->tableRow }}
        </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endforeach
@stop