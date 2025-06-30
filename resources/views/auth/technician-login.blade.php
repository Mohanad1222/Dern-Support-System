@extends('layouts.main-tailwind')

@section('title', 'Create Account')

@section('main')

<div class="min-h-screen w-full flex items-center justify-center">
    <div class="w-full max-w-sm bg-white/5 rounded-xl p-6 backdrop-blur-md shadow-lg">
        <h1 class="text-4xl font-semibold text-center text-white mb-6">Technician Login</h1>

        <form action="{{ route('technician.login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="technician-name" class="block text-sm font-medium text-gray-300 mb-1">Technician Name</label>
                <input
                    type="text"
                    id="technician-name"
                    name="technician_name"
                    placeholder="Enter Technician Name"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label for="technician-password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input
                    type="password"
                    id="technician-password"
                    name="password"
                    placeholder="Enter Password"
                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div class="mt-4">
                <input type="submit" value="Log In"
                    class="w-full cursor-pointer px-4 py-2 rounded-lg bg-blue-500/20 text-white border border-blue-400/30 hover:bg-blue-500/30 transition">
            </div>

            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-400">{{ $error }}</p>
            @endforeach
        </form>
    </div>
</div>


@endsection