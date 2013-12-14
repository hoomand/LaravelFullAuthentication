@extends('layout.master')

@section('title')
@parent
:: Password Reset
@stop

@section('content')
    <h2>Password Reset</h2>
    {{ Form::open(array('route' => array('password/reset', $token), 'method' => 'POST')) }}
    {{ Form::token() }}
    <table class="table">
        <tr>
            <td>{{ Form::label('email', 'Email') }}</td>
            <td>
                {{ Form::text('email', Input::old('email'), array('class' => 'form-control', "autofocus" => "True", 'placeholder' => 'bijan@example.com')) }}
            </td>
        </tr>
        <tr>
            <td>{{ Form::label('password', 'Password') }}</td>
            <td>
                {{ Form::password('password', array('class' => 'form-control')) }}
            </td>
        </tr>
        <tr>
            <td>{{ Form::label('password_confirmation', 'Password Confirmation') }}</td>
            <td>
                {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
            </td>
        </tr>
        <tr>
            <td colspan="2">{{ Form::submit(ucwords('update password'), array('class' => "btn btn-primary btn-sm active pull-right")) }}</td>
        </tr>
    </table>
    {{ Form::hidden('token', $token) }}

    {{ Form::close() }}
@stop
