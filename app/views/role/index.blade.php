@extends('layout.master')

@section('title')
@parent
:: Roles List
@stop

@section('content')
    {{ HTML::link('role/create', 'Add Role', array('class' => "btn btn-success btn-sm active")) }}
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
                {{ HTML::link('role/edit/' . $role->id, 'Edit', array('class' => "btn btn-primary btn-sm active")) }}
                {{ HTML::link('role/delete/' . $role->id, 'Delete', array('class' => "btn btn-danger btn-sm active")) }}
            </td>
        </tr>
        @endforeach
    </table>
@stop
