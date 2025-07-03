@extends('layouts.main-tailwind')

@section('title', 'Welcome to Dern Support')

@section('main')

    {{-- Nav Bar --}}
    <nav class="bg-gray-800 bg-white/5 backdrop-blur-md shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a class="text-xl font-semibold text-white" href="{{ route('landing') }}">Dern-Support</a>
            <div>
                @if (Auth::check())
                    <div class="relative inline-block text-left">
                        <!-- Toggle Button -->
                        <button id="user-dropdown-toggle"
                            class="flex items-center gap-2 px-5 py-2 rounded-lg bg-white/10 text-white border border-white/20 hover:bg-white/20 transition backdrop-blur-md"
                            onclick="toggleUserDropdown()">
                            <i data-lucide="circle-user" class="w-5 h-5"></i>
                            <span class="leading-none">Welcome, {{ Auth::user()->user_name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-blue-300"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown"
                            class="hidden absolute right-0 mt-2 w-44 rounded-lg bg-white/10 text-white backdrop-blur-md shadow-lg border border-white/20 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-white/20 transition flex">
                                <i data-lucide="cog" class="w-6 h-6 mr-2"></i>
                                Dashboard
                            </a>

                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 hover:bg-red-500/20 transition flex text-red-500">
                                    <i data-lucide="circle-arrow-right" class="w-6 h-6 mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <script>
                        function toggleUserDropdown() {
                            const dropdown = document.getElementById('user-dropdown');
                            dropdown.classList.toggle('hidden');

                            // Close dropdown on outside click
                            document.addEventListener('click', function handleOutsideClick(e) {
                                const toggle = document.getElementById('user-dropdown-toggle');
                                if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
                                    dropdown.classList.add('hidden');
                                    document.removeEventListener('click', handleOutsideClick);
                                }
                            });
                        }
                    </script>
                @else
                    <a href="{{ route('auth.login.form') }}"
                        class="flex items-center gap-2 px-5 py-2 rounded-lg bg-white/10 text-white border border-white/20 hover:bg-white/20 transition">
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                        <span class="leading-none">Login</span>
                    </a>
                @endif
            </div>
        </div>
    </nav>

    {{-- Hero section --}}
    <section class="flex flex-col justify-center items-center text-center h-[calc(100vh-80px)] px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Welcome to Dern-Support</h1>
        <p class="text-lg md:text-xl text-gray-300 mb-8">Your reliable support solution</p>
        <div class="flex gap-4">
            <a href="#pros"
                class="flex items-center gap-2 px-5 py-2 rounded-lg bg-white/10 text-white border border-white/20 hover:bg-white/20 transition">
                <i data-lucide="handshake" class="w-5 h-5"></i>
                <span class="leading-none">Why Choose Us?</span>
            </a>
            @if (Auth::check())
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-5 py-3 rounded-lg bg-white/10 text-white border border-white/20 hover:bg-white/20 transition">
                    <i data-lucide="cog" class="w-5 h-5"></i>
                    <span class="leading-none">Visit Dashboard</span>
                </a>
            @else
                <a href="{{ route('auth.login.form') }}"
                    class="flex items-center gap-2 px-5 py-3 rounded-lg bg-white/10 text-white border border-white/20 hover:bg-white/20 transition">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    <span class="leading-none">Login</span>
                </a>
            @endif
        </div>
    </section>

    {{-- Pros section --}}
    <section id="pros" class="relative z-20 py-16 mb-20">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Why Choose Dern Support?</h2>
            <p class="text-gray-300 max-w-2xl mx-auto mb-12">We combine reliable infrastructure with responsive support to
                give you the best experience possible.</p>

            <div class="grid md:grid-cols-3 gap-8">
                <div
                    class="bg-gray-800 bg-white/8 backdrop-blur-md shadow-lg rounded-xl p-6 hover:bg-white/10 transition duration-400 cursor-pointer">
                    <h3 class="flex items-center justify-center gap-2 text-xl font-semibold text-blue-400 mb-2">
                        <i data-lucide="clock" class="w-5 h-5 inline-block align-middle"></i>
                        Fast Response
                    </h3>

                    <p class="text-gray-200 text-sm">Your support requests are handled within minutes by real humans who
                        know what they’re doing.</p>
                </div>


                <div
                    class="bg-gray-800 bg-white/8 backdrop-blur-md shadow-lg rounded-xl p-6 hover:bg-white/10 transition duration-400 cursor-pointer">
                    <h3 class="flex items-center justify-center gap-2 text-xl font-semibold text-blue-400 mb-2">
                        <i data-lucide="shield-check" class="w-5 h-5 inline-block align-middle"></i>
                        Secure Platform
                    </h3>

                    <p class="text-gray-200 text-sm">We take privacy and security seriously — your data stays encrypted,
                        isolated, and safe.</p>
                </div>

                <div
                    class="bg-gray-800 bg-white/8 backdrop-blur-md shadow-lg rounded-xl p-6 hover:bg-white/10 transition duration-400 cursor-pointer">
                    <h3 class="flex items-center justify-center gap-2 text-xl font-semibold text-blue-400 mb-2">
                        <i data-lucide="radar" class="w-5 h-5 inline-block align-middle"></i>
                        Real-Time Tracking
                    </h3>

                    <p class="text-gray-200 text-sm">Track your requests and technician progress in real time with our
                        dashboard system.</p>
                </div>
            </div>
        </div>
    </section>


    {{-- Feedback section --}}
    <section id="feedback" class="py-16 px-6 bg-gray-800 bg-white/5 backdrop-blur-md shadow-lg">
        <h2 class="text-center text-3xl font-bold text-white mb-10">User Feedback</h2>
        <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($feedbacks as $feedback)
                <div class="bg-gray-800 bg-white/10 backdrop-blur-md shadow-lg rounded-xl p-6">
                    <p class="mb-4 italic">"{{ $feedback->feedback_text }}"</p>
                    <h5 class="font-semibold text-blue-400">{{ $feedback->feedback_rate }}/10</h5>
                    <h5 class="text-sm text-gray-400 text-right mt-4">{{ $feedback->request->user->user_name }}</h5>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-6 pt-10">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <p>&copy; {{ date('Y') }} Dern-Support. All rights reserved.</p>
            <div class="mt-4 md:mt-0 space-x-4">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
            </div>
        </div>
    </footer>


@endsection
