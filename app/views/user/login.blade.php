@extends('layout.master')

@section('title')
@parent
:: Login
@stop

@section('content')
    <h2>Login</h2>
    {{ Form::open(array('route' => 'login', 'method' => 'POST')) }}
    {{ Form::token() }}
    <table class="table">
        <tr>
            <td>{{ Form::label('username', 'Username') }}</td>
            <td>{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'autofocus' => 'True')) }}</td>
        </tr>
        <tr>
            <td>{{ Form::label('password', 'Password') }}</td>
            <td>{{ Form::password('password', array('class' => 'form-control')) }}</td>
        </tr>
        @if ($failedLogins > 2)
            <tr>
                <td>{{ Form::label('captcha', 'Code') }}</td>
                <td>{{ Form::text('captcha') }}</td>
            </tr>
            <tr>
                <td colspan="2">{{ HTML::image(Captcha::img(), 'Captcha image') }}</td>
            </tr>
        @endif
    </table>
    {{ HTML::link('password/request', 'Forgot Password?', array('class' => "btn btn-info btn-sm active pull-right")) }}
    {{ Form::submit('Login', array('class' => "btn btn-primary btn-sm active pull-right")) }}
    {{ Form::close() }}
@stop
