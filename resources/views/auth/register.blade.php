@extends('layouts.main')

@section('title', 'Create Account')

@section('main')

<div class="container-fluid vh-100 vw-100 d-flex align-items-center justify-content-center">
    <div class="w-25 border border-2 rounded p-3">
        <h1 class="text-center">Create New Account</h1>
        <form action={{route('auth.register')}} method="POST">
            @csrf
            <div class="form-floating my-4">
                <input type="text" class="form-control" id="new-username-input" placeholder="Choose Your Username." name="user_name">
                <label for="new-username-input">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="new-password-input" placeholder="Choose Your Password" name="user_password">
                <label for="new-password-input">Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="new-password-input-confirm" placeholder="Confirm Your Password" name="user_password_confirmation">
                <label for="new-password-input">Confirm Password</label>
            </div>
            <input class="btn btn-primary" type="submit" value="Create Your Account">
            @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
        </form>

    </div>

</div>

@endsection