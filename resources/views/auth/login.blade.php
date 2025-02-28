@extends('layouts.main')

@section('title', 'Login')

@section('main')

<div class="container-fluid vh-100 vw-100 d-flex align-items-center justify-content-center">
    <div class="w-25 border border-2 rounded p-3">
        <h1 class="text-center">Log-in</h1>
        <form action={{route('auth.login')}} method="POST">
            @csrf
            <div class="form-floating my-4">
                <input type="text" class="form-control" id="username-input" placeholder="Enter Your Username." name="user_name">
                <label for="username-input">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password-input" placeholder="Enter Your Password" name="password">
                <label for="password-input">Password</label>
            </div>
            <input class="btn btn-primary" type="submit" value="Log-in">
            @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
        </form>

    </div>

</div>

@endsection


