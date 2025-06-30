@extends('layouts.main-tailwind')

@section('title', 'Login')

@section('main')

<div class="min-h-screen w-full flex items-center justify-center">
    <div class="w-full max-w-sm bg-white/5 rounded-xl p-6 backdrop-blur-md shadow-lg">
        <h1 class="text-4xl font-semibold text-center text-white mb-6">Log In</h1>

        <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="username-input" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                <input
                    type="text"
                    id="username-input"
                    name="user_name"
                    placeholder="Enter Your Username"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="password-input" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input
                    type="password"
                    id="password-input"
                    name="password"
                    placeholder="Enter Your Password"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div class="flex items-center justify-between mt-4">
                <input type="submit" value="Log-in"
                    class="cursor-pointer px-4 py-2 rounded-lg bg-blue-500/20 text-white border border-blue-400/30 hover:bg-blue-500/30 transition">
                <a href="{{ route('auth.register.form') }}" class="text-sm text-blue-300 hover:underline">
                    Don't have an account?
                </a>
            </div>

            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-400">{{ $error }}</p>
            @endforeach
        </form>
    </div>
</div>


@endsection


