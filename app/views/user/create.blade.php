@extends('layout.master')

@section('title')
@parent
:: User Create
@stop

@section('content')
    <h3>Create New User</h3>
    {{ Form::Open(array('route' => 'user_create', 'method' => 'post')) }}
    {{ Form::token() }}
    <table class="table">
         <tr>
            <th>{{ Form::label('username', 'User Name') }}:</th>
            <td colspan='3'>{{ Form::text('username',  '', array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('first_name', 'First Name') }}:</th>
            <td>{{ Form::text('first_name',  '', array('class' => 'form-control')) }}</td>
            <th>{{ Form::label('last_name', 'Last Name') }}:</th>
            <td>{{ Form::text('last_name', '', array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('password', 'Password') }}:</th>
            <td>{{ Form::password('password', array('class' => 'form-control')) }}</td>
            <th>{{ Form::label('password_confirmation', 'Repeat Password') }}:</th>
            <td>{{ Form::password('password_confirmation', array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('gender', 'Gender') }}:</th>
            <td>
                {{ Form::radio('gender', 'male', true, array('id' => 'male')) }} {{ Form::label('male', 'Male') }}
                {{ Form::radio('gender', 'female', false, array('id' => 'female')) }} {{ Form::label('female', 'Female') }}
            </td>
            <th>{{ Form::label('email', 'Email') }}:</th>
            <td>{{ Form::email('email', '', array('class' => 'form-control')) }}</td>
        </tr>
         <tr>
             <th>{{ Form::label('phone', 'Phone') }}:</th>
             <td>{{ Form::text('phone', '', array('class' => 'form-control')) }}</td>
             <th>{{ Form::label('cellphone', 'Cell Phone') }}:</th>
             <td>{{ Form::text('cellphone', '', array('class' => 'form-control')) }}</td>
        </tr>
    </table>
    {{ Form::submit('Save', array('class' => "btn btn-primary btn-sm active")) }}
    {{ Form::close() }}
@stop
