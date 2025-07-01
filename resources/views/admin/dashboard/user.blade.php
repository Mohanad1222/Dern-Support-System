@extends('layouts.dashboard-layout')
@section('nav-brand', 'Admin Dashboard')
@section('title', $user->user_name)

@php
    $showSideBar = false;
@endphp

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col justify-items-start items-start">
            
            <h1 class="text-3xl font-bold text-white mb-6">Name: {{$user->user_name}}</h1>
            <h1 class="text-3xl font-bold text-white mb-6">Role: {{$user->role}}</h1>
            <h1 class="text-3xl font-bold text-white mb-6">Number Of Requests: {{$requests->count()}}</h1>
            <h1 class="text-3xl font-bold text-white mb-6">User Requests: </h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id</th>
                        <th class="px-6 py-4">request title</th>
                        <th class="px-6 py-4">request description</th>
                        <th class="px-6 py-4">request status</th>
                        <th class="px-6 py-4">request creation time</th>
                        <th class="px-6 py-4">device</th>
                        <th class="px-6 py-4">payment</th>
                        <th class="px-6 py-4">feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <th class="px-6 py-4">{{ $request->request_id }}</th>
                            <td class="px-6 py-4">{{ $request->request_title }}</td>
                            <td class="px-6 py-4">{{ $request->request_description }}</td>
                            <td class="px-6 py-4">{{ $request->request_status }}</td>
                            <td class="px-6 py-4">{{ $request->created_at }}</td>
                            <td class="px-6 py-4">

                                <button
                                    class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#device-modal-{{$request->request_id}}">
                                    {{$request->device->device_name}}
                                </button>

                            </td>
                            <td class="px-6 py-4">

                                <button
                                    class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#payment-modal-{{$request->request_id}}">
                                    {{$request->payment->payment_amount}}
                                </button>

                            </td>
                            <td class="px-6 py-4">

                                <button
                                    class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#feedback-modal-{{$request->request_id}}">
                                    {{$request->feedback->feedback_rate}}
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
@push('modals')
    @foreach ($requests as $request)
    <div class="modal fade" id="device-modal-{{$request->request_id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                <div class="modal-body text-sm text-gray-300">
                    <h4>
                        Device Name: {{ $request->device->device_name }}
                    </h4>
                    <h4>
                        Device Status: {{ $request->device->device_status }}

                    </h4>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="payment-modal-{{$request->request_id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                <div class="modal-body text-sm text-gray-300">
                    <h4>
                        Payment Amount: {{ $request->payment->payment_amount }}
                    </h4>
                    <h4>
                        Payment Method: {{ $request->payment->payment_method }}
                    </h4>
                    <h4>
                        Payment Status: {{ $request->payment->payment_status }}
                    </h4>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="feedback-modal-{{$request->request_id}}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                <div class="modal-body text-sm text-gray-300">
                    <h4>
                        Feedback Rate: {{ $request->feedback->feedback_rate }}
                    </h4>
                    <h4>
                        Feedback Text: {{ $request->feedback->feedback_text }}
                    </h4>
                    <h4>
                        Feedback Status: {{ $request->feedback->feedback_status }}
                    </h4>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    
@endpush