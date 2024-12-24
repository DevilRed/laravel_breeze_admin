@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content_header')
    <h1>Staff Dashboard</h1>
@stop

@section('content')
    <p>content for staff dashboard</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
