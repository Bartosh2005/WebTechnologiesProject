<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Vault</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @section('header') // This defines a section which gets displayed via "yield"
    @endsection
    
    <footer>
        <p>&copy; 2025 Game Library</p>
    </footer>
</body>
</html>-->

@extends('layouts.master')
 
<!--@section('title', 'MyCollection')-->
 
@section('content2')
    @@parent
    <p>This is appended to the master content place.</p>
@stop
