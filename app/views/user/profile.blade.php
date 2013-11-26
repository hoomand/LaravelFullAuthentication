@extends('layout.master')

@section('title')
@parent
:: Profile
@stop

@section('content')
    <h3>{{ Auth::user()->username }}</h3>

@stop
