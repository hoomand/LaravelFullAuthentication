@extends('layout.master')

@section('title')
@parent
:: User Edit
@stop

@section('content')
    <h3>Editing <span class="text-info">{{ $user->username }}</span></h3>
    
    {{ Form::Open(array('route' => 'user_edit_post', 'method' => 'post')) }}
    {{ Form::token() }}
    <table class="table">
        <tr>
            <th>{{ Form::label('first_name', 'First Name') }}:</th>
            <td>{{ Form::text('first_name',  $user->first_name, array('class' => 'form-control')) }}</td>
            <th>{{ Form::label('last_name', 'Last Name') }}:</th>
            <td>{{ Form::text('last_name', $user->last_name, array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('gender', 'Gender') }}:</th>
            <td>
                {{ Form::radio('gender', 'male', ($user->gender == 'male') ? true : false, array('id' => 'male')) }} {{ Form::label('male', 'Male') }}
                {{ Form::radio('gender', 'female', ($user->gender == 'female') ? true : false, array('id' => 'female')) }} {{ Form::label('female', 'Female') }}
            </td>
            <th>{{ Form::label('email', 'Email') }}:</th>
            <td>{{ Form::email('email', $user->email, array('class' => 'form-control')) }}</td>
        </tr>
         <tr>
             <th>{{ Form::label('phone', 'Phone') }}:</th>
             <td>{{ Form::text('phone', $user->phone, array('class' => 'form-control')) }}</td>
             <th>{{ Form::label('cellphone', 'Cell Phone') }}:</th>
             <td>{{ Form::text('cellphone', $user->cellphone, array('class' => 'form-control')) }}</td>
        </tr>
        

    </table>
    {{ Form::submit('Update', array('class' => "btn btn-primary btn-sm active")) }}
    {{ Form::close() }}
@stop
