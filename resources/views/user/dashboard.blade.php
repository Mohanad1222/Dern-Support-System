@extends('layouts.main')

@section('title', $user->user_name)

@section('main')

    <h1>User DASHBOARD</h1>

    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach


    <h4>USER NAME: {{ $user->user_name }}</h4>
    <h4>USER ROLE: {{ $user->role }}</h4>

    <h6>USER REQUESTS</h6>

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-request-modal">
        Make Request
    </button>

    <div class="modal fade" id="create-request-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('user.request.create') }}" method="POST">
                        @csrf
                        <input name="request_title" type="text" placeholder="request title">
                        <input name="request_description" type="text" placeholder="request Description">
                        <input name="device_name" type="text" placeholder="device name">
                        <input type="submit" value="Create Request">
                    </form>
                </div>

            </div>
        </div>
    </div>

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
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#device-modal-{{ $request->request_id }}">
                            {{ $request->device->device_name }}
                        </button>

                        <div class="modal fade" id="device-modal-{{ $request->request_id }}" tabindex="-1">
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
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#payment-modal-{{ $request->request_id }}">
                            {{ $request->payment->payment_amount }}
                        </button>

                        <div class="modal fade" id="payment-modal-{{ $request->request_id }}" tabindex="-1">
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

                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#feedback-modal-{{ $request->request_id }}">
                            {{ $request->feedback->feedback_rate }}
                        </button>

                        <div class="modal fade" id="feedback-modal-{{ $request->request_id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h4>
                                            Give Feedback
                                        </h4>
                                        <form
                                            action="{{ route('feedbacks.update', ['feedback' => $request->feedback->request_id]) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')
                                            <label for="feedback_rate">Feedback rate</label>
                                            <input id="range-{{$request->feedback->request_id}}" name="feedback_rate" type="range" min="0" max="10"
                                                value="{{ $request->feedback->feedback_rate }}">
                                            <p id="output-{{$request->feedback->request_id}}">{{ $request->feedback->feedback_rate }}</p> <!-- Output display -->
                                            
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    var slider = document.getElementById("range-{{ $request->feedback->request_id }}");
                                                    var output = document.getElementById("output-{{ $request->feedback->request_id }}");
                                                    
                                                    output.innerHTML = slider.value; // Display the default slider value
                                            
                                                    // Update the current slider value (each time you drag the slider handle)
                                                    slider.oninput = function() {
                                                        output.innerHTML = this.value;
                                                    }
                                                });
                                            </script>
                                            <label for="feedback_text">Feedback Text:</label>
                                            <input type="text" name="feedback_text" id="feedback_text" value="{{$request->feedback->feedback_text}}"></input>
                                            <input type="submit" value="Save Changes">
                                        </form>
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
