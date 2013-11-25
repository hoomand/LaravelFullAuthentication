@extends('layout.master')

@section('title')
@parent
:: Login
@stop

@section('content')
    <h2>Login</h2>
    {{ Form::open(array('route' => 'user/login', 'method' => 'POST')) }}
    {{ Form::token() }}
    <p>
        {{ Form::label('username', 'Username') }}<br />
        {{ Form::text('username', Input::old('username'), array("autofocus" => "True")) }}
    </p>
    <p>
        {{ Form::label('password', 'Password') }}<br />
        {{ Form::password('password') }}
    </p>
    <p>{{ Form::submit('Login') }}</p>

    {{ Form::close() }}
@stop
