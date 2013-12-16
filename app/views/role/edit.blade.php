@extends('layout.master')

@section('title')
@parent
:: Role Edit
@stop

@section('content')
    <h3>Edit Role <span class="text-info">{{ $role->name }}</span></h3>

    {{ Form::Open(array('url' => 'role/edit/' . $role->id, 'method' => 'post')) }}
    {{ Form::token() }}

    <table class="table">
        <tr>
            <th>{{ Form::label('name', 'Role Name') }}:</th>
            <td>{{ Form::text('name',  $role->name, array('class' => 'form-control')) }}</td>
        </tr>
        <tr>
            <th>{{ Form::label('description', 'Role Description') }}:</th>
            <td>{{ Form::textarea('description', $role->description, array('class' => 'form-control')) }}</td>
        </tr>
    </table>
    {{ Form::submit('Update', array('class' => "btn btn-primary btn-sm active pull-right")) }}
    {{ Form::close() }}
    {{ HTML::link('role/index', 'Back', array('class' => 'btn btn-warning btn-sm active pull-right')) }}

    <br />
    <br />
    <h4>Permissions</h4>
    {{ Form::open(array('url' => 'role/edit/perms/' . $role->id, 'method' => 'post')) }}
    <table class="table">
    @foreach($all_permissions as $permission)
    <tr>
        <td>{{ Form::checkbox('permissions[]', $permission->id, ( in_array($permission->id, $role_permission_ids) ? true : false )) }} {{ ucwords($permission->display) }}</td>
    </tr>
    @endforeach
    </table>
    {{ Form::submit('Update', array('class' => 'btn btn-primary btn-sm active pull-right')) }}
    {{ Form::close() }}



@stop
