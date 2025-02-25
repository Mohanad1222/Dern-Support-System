@extends('layouts.main')

@section('title', $user->user_name)

@section('main')

    <h1>ADMIN DASHBOARD</h1>
    <form action="{{route('auth.logout')}}" method="post">
        @csrf
        <input class="btn btn-danger" type="submit" value="LOGOUT">
    </form>
    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach


    <h4>USER NAME: {{ $user->user_name }}</h4>
    <h4>USER ROLE: {{ $user->role }}</h4>

    <h6>USER REQUESTS</h6>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Request Title</th>
                <th scope="col">Request Description</th>
                <th scope="col">Request Status</th>
                <th scope="col">Request creation time</th>
                <th scope="col">Device</th>
                <th scope="col">Payment</th>
                <th scope="col">Feedback</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($requests as $request)
                <tr class="align-middle">
                    <th scope="row">{{ $request->request_id }}</th>
                    <td>{{ $request->request_title }}</td>
                    <td>{{ $request->request_description }}</td>
                    <td>{{ $request->request_status }}</td>
                    <td>{{ $request->created_at }}</td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#device-modal-{{$request->request_id}}">
                            {{ $request->device->device_name }}
                        </button>

                        <div class="modal fade" id="device-modal-{{$request->request_id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
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
                    </td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#payment-modal-{{$request->request_id}}">
                            {{ $request->payment->payment_amount }}
                        </button>

                        <div class="modal fade" id="payment-modal-{{$request->request_id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
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
                    </td>
                    <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedback-modal-{{$request->request_id}}">
                            {{ $request->feedback->feedback_rate }}
                        </button>

                        <div class="modal fade" id="feedback-modal-{{$request->request_id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
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
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
