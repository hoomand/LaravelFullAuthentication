@extends('layout.master')

@section('title')
@parent
:: Profile
@stop

@section('content')
    <h3>{{ Auth::user()->username }}</h3>
    
    <table class="table">
        <tr>
            <th>First Name:</th>
            <td>{{ Auth::user()->first_name }}</td>
            <th>Last Name:</th>
            <td>{{ Auth::user()->last_name }}</td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td>{{ Auth::user()->gender }}</td>
            <th>Email:</th>
            <td>{{ Auth::user()->email }}</td>
        </tr>
         <tr>
            <th>Phone:</th>
            <td>{{ Auth::user()->phone }}</td>
            <th>Cell Phone:</th>
            <td>{{ Auth::user()->cellphone }}</td>
        </tr>
        

    </table>
    @if ( allowed('profile_edit') )
        {{ HTML::link(route('user/profile/edit'), 'Edit Profile', array('class' => "btn btn-primary btn-sm active pull-right")) }}
    @endif
    @if ( allowed('profile_edit_password') )
        {{ HTML::link(route('user.profile.edit.password'), 'Change Password', array('class' => "btn btn-primary btn-sm active pull-right")) }}
    @endif
@stop
