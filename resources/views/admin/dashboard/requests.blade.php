@extends('layouts.main')

@section('title', 'USER REQUESTS')

@section('main')

    <h1>ADMIN DASHBOARD</h1>

    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach




    <div class="container-fluid mt-5">
        <div class="row g-0">
            <!-- Tabs (Left Side) -->
            <div class="col-md-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <x-tabs.tab route="dashboard.users" text="Users" />
                    <x-tabs.tab route="dashboard.technicians" text="Technicians" />
                    <x-tabs.tab route="dashboard.requests" text="Requests" :isActive="true" />
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <div class="col-md-10">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
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
                                <th><a
                                        href="{{ route('dashboard.users', ['user' => $request->user->id]) }}">{{ $request->user->user_name }}</a>
                                </th>
                                <td>{{ $request->request_title }}</td>
                                <td>{{ $request->request_description }}</td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#request-modal-{{ $request->request_id }}">
                                        {{ $request->request_status }}
                                    </button>

                                    <div class="modal fade" id="request-modal-{{ $request->request_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h4>
                                                        Request Status
                                                    </h4>
                                                    <form
                                                        action="{{ route('requests.update', ['user_request' => $request->request_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="request_status">Request Status:</label>
                                                        <select id="request_status" name="request_status">
                                                            <option
                                                                {{ $request->request_status == 'awaiting delivery' ? 'selected' : '' }}
                                                                value="awaiting delivery">Awaiting Delivery</option>
                                                            <option
                                                                {{ $request->request_status == 'received' ? 'selected' : '' }}
                                                                value="received">Received</option>
                                                            <option
                                                                {{ $request->request_status == 'in progress' ? 'selected' : '' }}
                                                                value="in progress">In Progress</option>
                                                            <option
                                                                {{ $request->request_status == 'awaiting payment' ? 'selected' : '' }}
                                                                value="awaiting payment">Awaiting Payment</option>
                                                            <option
                                                                {{ $request->request_status == 'completed' ? 'selected' : '' }}
                                                                value="completed">Completed</option>
                                                        </select>
                                                        <input type="submit" value="Save Changes">
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
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
                                                    <form
                                                        action="{{ route('devices.update', ['device' => $request->device->request_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="device_status">Device Status:</label>
                                                        <select id="device_status" name="device_status">
                                                            <option
                                                                {{ $request->request_status == 'awaiting delivery' ? 'selected' : '' }}
                                                                value="awaiting delivery">Awaiting Delivery</option>
                                                            <option
                                                                {{ $request->request_status == 'delivered' ? 'selected' : '' }}
                                                                value="delivered">Delivered</option>
                                                            <option
                                                                {{ $request->request_status == 'returned' ? 'selected' : '' }}
                                                                value="returned">Returned</option>
                                                        </select>
                                                        <input type="submit" value="Save Changes">
                                                    </form>
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
                                                    <form
                                                        action="{{ route('payments.update', ['payment' => $request->payment->request_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <h4>
                                                            Payment Amount:
                                                        </h4>
                                                        <input type="number" name="payment_amount"
                                                            value="{{ $request->payment->payment_amount }}">
                                                        <h4>
                                                            Payment Method:
                                                        </h4>
                                                        <select name="payment_method">
                                                            <option
                                                                {{ $request->payment->payment_method == 'cash' ? 'selected' : '' }}
                                                                value="cash">Cash</option>
                                                            <option
                                                                {{ $request->payment->payment_method == 'visa' ? 'selected' : '' }}
                                                                value="visa">Visa</option>
                                                            <option
                                                                {{ $request->payment->payment_method == 'mastercard' ? 'selected' : '' }}
                                                                value="mastercard">MasterCard</option>
                                                            <option
                                                                {{ $request->payment->payment_method == 'paypal' ? 'selected' : '' }}
                                                                value="paypal">PayPal</option>
                                                            <option
                                                                {{ $request->payment->payment_method == 'bank transfer' ? 'selected' : '' }}
                                                                value="bank transfer">Bank Transfer</option>
                                                        </select>
                                                        <h4>
                                                            Payment Status: {{ $request->payment->payment_status }}
                                                        </h4>
                                                        <select name="payment_status">
                                                            <option
                                                                {{ $request->payment->payment_status == 'awaiting payment' ? 'selected' : '' }}
                                                                value="awaiting payment">Awaiting payment</option>
                                                            <option
                                                                {{ $request->payment->payment_status == 'payment received' ? 'selected' : '' }}
                                                                value="payment received">Payment received</option>
                                                        </select>

                                                        <input type="submit" value="Save Changes">

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#feedback-modal-{{ $request->request_id }}">
                                        {{ $request->feedback->feedback_rate }}/10
                                    </button>

                                    <div class="modal fade" id="feedback-modal-{{ $request->request_id }}"
                                        tabindex="-1">
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

            </div>
        </div>
    </div>

@endsection
