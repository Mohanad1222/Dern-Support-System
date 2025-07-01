<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-900 text-white">

    <nav class="bg-gray-800 bg-white/5 backdrop-blur-md shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a class="text-xl font-semibold text-white" href="{{route('dashboard')}}">Dern-Support {{Auth::user()->role == 'admin' ? 'Admin' : 'User'}} Dashboard</a>
            <form action="{{ route('auth.logout') }}" method="post">
                @csrf
                <button
                    class="flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500/20 text-white hover:bg-red-500/30 transition cursor-pointer"
                    type="submit">
                    <i data-lucide="circle-arrow-right" class="w-5 h-5 text-red-400"></i>
                    Log Out
                </button>


            </form>
        </div>
    </nav>
    <div class="flex">
        @php
            $showSideBar = $showSideBar ?? true;
        @endphp
        @if ($showSideBar)
            <aside class="m-6 w-60 h-fit bg-white/10 backdrop-blur-md rounded-xl p-3 border border-white/20 shadow-lg">
                <nav class="flex flex-col gap-2">
                    <a
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard') ? 'bg-blue-500/30' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{route('dashboard.users')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.users') ? 'bg-blue-500/50' : '' }}">
                        Users
                    </a>
                    <a href="{{route('dashboard.technicians')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.technicians') ? 'bg-blue-500/50' : '' }}">
                        Technicians
                    </a>
                    <a href="{{route('dashboard.requests')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.requests') ? 'bg-blue-500/50' : '' }}">
                        Requests
                    </a>
                    <a href="{{route('dashboard.devices')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.devices') ? 'bg-blue-500/50' : '' }}">
                        Devices
                    </a>
                    <a href="{{route('dashboard.payments')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.payments') ? 'bg-blue-500/50' : '' }}">
                        Payments
                    </a>
                    <a href="{{route('dashboard.feedbacks')}}"
                        class="px-4 py-2 rounded-lg hover:bg-blue-500/15 transition {{ request()->routeIs('dashboard.feedbacks') ? 'bg-blue-500/50' : '' }}">
                        Feedback
                    </a>
                    <!-- Add more links here -->
                </nav>
            </aside>
        @endif
        <div class="w-100">
            @yield('main')
    
        </div>

    </div>
    
    <script>
        lucide.createIcons();
    </script>

    @stack('modals')
</body>
</html>
