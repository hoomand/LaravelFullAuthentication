@extends('layout.master')

@section('title')
@parent
:: User List
@stop

@section('content')
    <h3>Users</h3>

    <table class="table">
        <tr>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Cell Phone</th>
            <th>Actions</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->gender}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->cellphone}}</td>
            <td>
                {{ HTML::link('user_edit/' . $user->id, 'Edit', array('class' => "btn btn-primary btn-sm active")) }}
            </td>
        </tr>
        @endforeach

    </table>

@stop
