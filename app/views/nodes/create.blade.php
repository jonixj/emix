@extends('layouts.master')

@section('content')
    <h1>Lets create a node!</h1>

    {{ Form::open() }}

        @include('nodes/partials/_form');

    {{ Form::close() }}

@stop