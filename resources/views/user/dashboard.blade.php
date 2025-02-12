@extends('layouts.main')

@section('title', 'Dashboard')

@section('main')

    <h1>USER DASHBOARD</h1>
    <a href="{{route('user.request.form')}}" class="btn btn-primary">JG</a>
    <h1>MY REQUESTS</h1>
    {{dd(vars: $requests)}}
    @foreach ($requests as $request)
    <h4>{{ $request->request_title }} {{ $request->request_description }} {{ $request->request_status }} {{$request->user->user_name}}</h4>    @endforeach

@endsection