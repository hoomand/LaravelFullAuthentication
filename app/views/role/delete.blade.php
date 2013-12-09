@extends('layout.master')

@section('title')
@parent
:: Role Delete
@stop

@section('content')
    <h3>Deleting role <span class="text-info">{{ $role->name }}</span></h3>
    
    {{ Form::Open(array('url' => 'role/delete/' . $role->id, 'method' => 'post')) }}
    {{ Form::token() }}
    <p>Are you sure that you want to delete <span class="text-warning">{{ $role->name }}</span>?</p>
    <br />
    @if ( count($role->users) > 0 )
        <p>The following users will be affected:</p>
        <table class="table table-bordered" style="width: 30%">
            @foreach ($role->users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <br /><br />
    {{ Form::submit('Yes', array('class' => "btn btn-danger btn-sm active")) }}
    {{ HTML::link(route('role/index'), 'No', array('class' => "btn btn-primary btn-sm active")) }}
    {{ Form::close() }}
@stop
