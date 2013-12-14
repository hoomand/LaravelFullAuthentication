@extends('layout.master')

@section('title')
@parent
:: Profile Edit Password
@stop

@section('content')
    <h3>Edit password - {{ Auth::user()->username }}</h3>
    
    {{ Form::Open(array('route' => 'user.profile.edit.password', 'method' => 'post')) }}
    {{ Form::token() }}
    <table class="table">
        <tr>
            <th>{{ Form::label('password', 'Password') }}:</th>
            <td>{{ Form::password('password', array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('password_confirmation', 'Password Confirmation') }}:</th>
            <td>{{ Form::password('password_confirmation', array('class' => 'form-control')) }}</td>
        </tr>
    </table>
    {{ Form::submit('Update', array('class' => "btn btn-primary btn-sm active pull-right")) }}
    {{ Form::close() }}
@stop
