@extends('layout.master')

@section('title')
@parent
:: Password Reset Request
@stop

@section('content')
    <h3>Password Reset Request</h3>
    {{ Form::open(array('route' => 'password/request', 'method' => 'POST')) }}
    {{ Form::token() }}
    <table class="table table-condensed" style="width: 40%">
        <tr>
            <td>{{ Form::label('email', 'Email') }}</td>
            <td>{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'autofocus' => 'True', 'placeholder' => 'bijan@example.com')) }}</td>
        </tr>
        <tr>
            <td colspan="2">{{ Form::submit('Reset', array('class' => 'btn btn-primary btn-sm active pull-right')) }}</td>
        </tr>
    </table>

    {{ Form::close() }}
@stop
