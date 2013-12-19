@extends('layout.master')

@section('title')
@parent
:: User List
@stop

@section('content')
    @if ( allowed('users_create') )
        {{ HTML::link('user/create', 'Create User', array('class' => "btn btn-success btn-sm active")) }}
    @endif
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
                @if ( allowed('users_edit') )
                {{ HTML::link('user/edit/' . $user->id, 'Edit', array('id' => 'edit_button_' . $user->username, 'class' => "btn btn-primary btn-sm active")) }}
                @endif
                @if ( allowed('users_delete') )
                    {{ HTML::link('user/delete/' . $user->id, 'Delete', array('class' => "btn btn-danger btn-sm active")) }}
                @endif
                @if ( allowed('users_edit_password') )
                    {{ HTML::link('user/edit/password/' . $user->id, 'Change Password', array('class' => "btn btn-primary btn-sm active")) }}
                @endif

            </td>
        </tr>
        @endforeach

    </table>

@stop
