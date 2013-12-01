@extends('layout.master')

@section('title')
@parent
:: Groups List
@stop

@section('content')
    <h3>Groups</h3>

    <table class="table">
        <tr>
            <th>Name</th>
        </tr>
        @foreach($groups as $group)
        <tr>
            <td>{{$group->name}}</td>
        </tr>
        @endforeach
    </table>
@stop
