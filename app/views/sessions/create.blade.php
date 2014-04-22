@extends('layout')

@section('header')
@stop

@section('content')
{{ HTML::style('css/login.css') }}

{{ Form::open(array('route' => 'sessions.store', 'class' => 'form-signin')) }}

    <h2 class="form-signin-heading">Please sign in</h2>

    {{ Form::text('email','',['class' => 'form-control', 'placeholder' => 'Email address', 'autofocus','required'])}}
    {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Password', 'required'])}}
    {{ Form::submit('Sign in',['class' => 'btn btn-lg btn-primary btn-block']) }}

{{ Form::close()}}
@stop