@extends('layout.master')

@section('title')
@parent
:: User Delete
@stop

@section('content')
    <h3>Deleting User <span class="text-info">{{ $user->username }}</span></h3>
    
    {{ Form::Open(array('url' => 'user/delete/' . $user->id, 'method' => 'post', 'id' => 'delete_user_form')) }}
    {{ Form::token() }}
    Are you sure that you want to delete <span class="text-warning">{{ $user->getFullName() }}</span>?
    <br /><br />
    {{ Form::submit('Yes', array('class' => "btn btn-danger btn-sm active")) }}
    {{ HTML::link(route('user/index'), 'No', array('class' => "btn btn-primary btn-sm active")) }}
    {{ Form::close() }}
@stop
