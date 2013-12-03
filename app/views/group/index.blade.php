@extends('layout.master')

@section('title')
@parent
:: Groups List
@stop

@section('content')
    {{ HTML::link('group/create', 'Create Group', array('class' => "btn btn-success btn-sm active")) }}
    <h3>Groups</h3>

    <table class="table">
        <tr>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
        @foreach($groups as $group)
        <tr>
            <td>{{$group->name}}</td>
             <td>
                {{ HTML::link('group/edit' . $group->id, 'Edit', array('class' => "btn btn-primary btn-sm active")) }}
                {{ HTML::link('group/delete' . $group->id, 'Delete', array('class' => "btn btn-danger btn-sm active")) }}
            </td>
        </tr>
        @endforeach
    </table>
@stop
