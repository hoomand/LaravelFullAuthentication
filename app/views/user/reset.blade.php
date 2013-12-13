@extends('layout.master')

@section('title')
@parent
:: Password Reset
@stop

@section('content')
    <h2>Password Reset</h2>
    {{ Form::open(array('url' => URL::route('user/reset') . $token, 'method' => 'POST')) }}
    {{ Form::token() }}
    <p>
        {{ Form::label('email', 'Email') }}<br />
        {{ Form::text('email', Input::old('email'), array("autofocus" => "True", 'placeholder' => 'bijan@example.com')) }}
    </p>
    <p>
        {{ Form::label('password', 'Password') }}<br />
        {{ Form::password('password') }}
    </p>
    <p>
        {{ Form::label('password_confirmation', 'Password Confirmation') }}<br />
        {{ Form::password('password_confirmation') }}
    </p>

    <p>{{ Form::submit('Reset') }}</p>

    {{ Form::close() }}
@stop
