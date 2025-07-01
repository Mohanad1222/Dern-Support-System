@extends('layouts.dashboard-layout')

@section('title', 'Manage Users')

@section('main')


    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage Users</h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id</th>
                        <th class="px-6 py-4">name</th>
                        <th class="px-6 py-4">role</th>
                        <th class="px-6 py-4"># of requests</th>
                        <th class="px-6 py-4">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->user_name }}</td>
                            <td class="px-6 py-4">{{ $user->role }}</td>
                            <td class="px-6 py-4">{{ $user->requests->count() }}</td>
                            <td class="px-6 py-4">

                                <button
                                    class="px-3 py-1 rounded-lg bg-red-500/20 text-white hover:bg-red-500/30 transition {{ $user->role == 'admin' ? 'disabled cursor-not-allowed opacity-50' : '' }}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $user->id }}"
                                    @if ($user->role === 'admin') disabled @endif>
                                    Delete
                                </button>

                                @if ($user->role === 'admin')
                                    <button
                                        class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition disabled cursor-not-allowed opacity-50"
                                        href="{{route('dashboard.users', ['user' => $user->id])}}"
                                        disabled>
                                        Details 
                                    </button>
                                @else
                                    <a
                                        class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                        href="{{route('dashboard.users', ['user' => $user->id])}}">
                                        Details 
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('modals')

    @foreach ($users as $user)
        <div class="modal fade" id="exampleModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Confirm Deletion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        Are you sure you want to delete this user? This action is <strong class="text-red-400">not
                            reversible</strong>.
                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="{{ route('users.delete', ['user' => $user->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button
                                class="cursor-pointer px-3 py-1 rounded-lg bg-red-500/20 text-white hover:bg-red-500/30 transition"
                                type="submit">
                                Delete
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endpush
