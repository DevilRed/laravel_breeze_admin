@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Admin Dashboard</h1>
@stop

@section('content')
    <p>content for admin dashboard <br> this is the layout and it should be put as a common layout for the application, so that it has common logic and sections there <br> <a href="https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Usage">check documentation</a> </p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
