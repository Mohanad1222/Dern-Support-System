@extends('layouts.dashboard-layout')
@section('nav-brand', 'Admin Dashboard')
@section('title', 'Feedbacks')

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach


    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage feedbacks</h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id (request/feedback)</th>
                        <th class="px-6 py-4">user name</th>
                        <th class="px-6 py-4">feedback rate</th>
                        <th class="px-6 py-4">feedback text</th>
                        <th class="px-6 py-4">feedback status</th>
                        <th class="px-6 py-4">feedback date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $feedback->request_id }}</td>
                            <td class="px-6 py-4"> <a
                                    href="{{ route('dashboard.users', ['user' => $feedback->request->user->id]) }}"
                                    class="underline underline-offset-3 decoration-dotted">
                                    {{ $feedback->request->user->user_name }}
                                </a></td>
                            <td class="px-6 py-4">{{ $feedback->feedback_rate }} / 10</td>
                            <td class="px-6 py-4">{{ $feedback->feedback_text }}</td>
                            <td class="px-6 py-4">{{ $feedback->feedback_status }}</td>
                            <td class="px-6 py-4">
                                {{ $feedback->feedback_status == 'given' ? $feedback->updated_at : 'Not given' }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
