@extends('layouts.main')

@section('title', 'Welcome to Dern Support')

@section('main')
    <nav class="navbar navbar-light bg-light">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="#">Dern-Support</a>
            <div>
                @if (Auth::check())
                    <a class="btn btn-outline-primary me-2" href="{{ route('dashboard') }}">Welcome,
                        {{ Auth::user()->user_name }}</a>
                @else
                    <a class="btn btn-outline-secondary me-2" href="{{ route('auth.login.form') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="d-flex flex-column justify-content-center align-items-center text-center vh-100">
        <h1>Welcome to Dern-Support</h1>
        <p>Your reliable support solution</p>
        @if (Auth::check())
            <a class="btn btn-primary" href="{{ route('dashboard') }}">Get Started</a>
        @else
            <a class="btn btn-primary" href="{{ route('auth.login.form') }}">Get Started</a>
        @endif
    </section>

    <!-- Feedback Section -->
    <section id="feedback" class="container py-5">
        <h2 class="text-center mb-4">User Feedback</h2>
        <div class="row">
            @foreach ($feedbacks as $feedback)
                <div class="col-md-4">
                    <div class="card p-3">
                        <p>"{{ $feedback->feedback_text }}"</p>
                        <h5>{{ $feedback->feedback_rate }}/10</h5>
                        <h5 class="text-end">{{ $feedback->request->user->user_name }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Dern-Support. All rights reserved.</p>
    </footer>
@endsection
