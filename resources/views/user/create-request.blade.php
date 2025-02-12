@extends('layouts.main')

@yield('title', 'create request')

@section('main')

<form action="{{route('user.request.create')}}" method="post">
    @csrf
    <input placeholder="req title" type="text" name="request_title">
    <input placeholder="red desc" type="text" name="request_description">
    <input placeholder="device name" type="text" name="device_name">
    <input type="submit" value="SUBMIT">
</form>

@endsection