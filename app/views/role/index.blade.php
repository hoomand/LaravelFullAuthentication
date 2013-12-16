@extends('layout.master')

@section('title')
@parent
:: Roles List
@stop

@section('content')
    @if ( allowed('roles_create') )
        {{ HTML::link('role/create', 'Add Role', array('class' => "btn btn-success btn-sm active")) }}
    @endif
    <h3>Roles</h3>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>{{$role->description}}</td>
             <td>
                @if ( allowed('roles_edit') )
                    {{ HTML::link('role/edit/' . $role->id, 'Edit', array('class' => "btn btn-primary btn-sm active")) }}
                @endif
                @if ( allowed('roles_delete') )
                    {{ HTML::link('role/delete/' . $role->id, 'Delete', array('class' => "btn btn-danger btn-sm active")) }}
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@stop
