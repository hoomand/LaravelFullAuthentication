@extends('layout.master')

@section('title')
@parent
:: Role Create
@stop

@section('content')
    <h3>Create Role</span></h3>

    {{ Form::Open(array('url' => 'role/create', 'method' => 'post')) }}
    {{ Form::token() }}
    <table class="table">
        <tr>
            <th>{{ Form::label('name', 'Role Name') }}:</th>
            <td>{{ Form::text('name', '', array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('description', 'Role Description') }}:</th>
            <td>{{ Form::textarea('description', '', array('class' => 'form-control')) }}</td>
        </tr>
    </table>

    <br />
    <h4>Permissions</h4>
    {{ Form::open(array('url' => 'role/create', 'method' => 'post')) }}
    <table class="table">
    @foreach($all_permissions as $permission)
    <tr>
        <td>{{ Form::checkbox('permissions[]', $permission->id ) }} {{ ucwords($permission->display) }}</td>
    </tr>
    @endforeach
    </table>
    {{ HTML::link('role/index', 'Back', array('class' => 'btn btn-warning btn-sm active pull-right')) }}
    {{ Form::submit('Create', array('class' => 'btn btn-primary btn-sm active pull-right')) }}
    {{ Form::close() }}
@stop
