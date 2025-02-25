@extends('layouts.main')

@section('title', 'PAYMENTS')

@section('main')

    <h1>ADMIN DASHBOARD</h1>
    <form action="{{route('auth.logout')}}" method="post">
        @csrf
        <input class="btn btn-danger" type="submit" value="LOGOUT">
    </form>
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
                    <x-tabs.tab route="dashboard.requests" text="Requests" />
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" :isActive="true" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <div class="col-md-10">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Request/Payment ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Payment Amount</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($payments as $payment)
                            <tr class="align-middle">
                                <th scope="row">{{ $payment->request_id }}</th>
                                <th><a
                                        href="{{ route('dashboard.users', ['user' => $payment->request->user->id]) }}">{{ $payment->request->user->user_name }}</a>
                                </th>
                                <td>{{ $payment->payment_amount }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->payment_status }}</td>
                                <td>{{ $payment->payment_status == 'payment received' ? $payment->updated_at : 'Not paid yet' }}
                                </td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#payment-modal-{{ $payment->request_id }}">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="payment-modal-{{ $payment->request_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('payments.update', ['payment' => $payment->request_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <h4>
                                                            Payment Amount:
                                                        </h4>
                                                        <input type="number" name="payment_amount"
                                                            value="{{ $payment->payment_amount }}">
                                                        <h4>
                                                            Payment Method:
                                                        </h4>
                                                        <select name="payment_method">
                                                            <option
                                                                {{ $payment->payment_method == 'cash' ? 'selected' : '' }}
                                                                value="cash">Cash</option>
                                                            <option
                                                                {{ $payment->payment_method == 'visa' ? 'selected' : '' }}
                                                                value="visa">Visa</option>
                                                            <option
                                                                {{ $payment->payment_method == 'mastercard' ? 'selected' : '' }}
                                                                value="mastercard">MasterCard</option>
                                                            <option
                                                                {{ $payment->payment_method == 'paypal' ? 'selected' : '' }}
                                                                value="paypal">PayPal</option>
                                                            <option
                                                                {{ $payment->payment_method == 'bank transfer' ? 'selected' : '' }}
                                                                value="bank transfer">Bank Transfer</option>
                                                        </select>
                                                        <h4>
                                                            Payment Status: {{ $payment->payment_status }}
                                                        </h4>
                                                        <select name="payment_status">
                                                            <option
                                                                {{ $payment->payment_status == 'awaiting payment' ? 'selected' : '' }}
                                                                value="awaiting payment">Awaiting payment</option>
                                                            <option
                                                                {{ $payment->payment_status == 'payment received' ? 'selected' : '' }}
                                                                value="payment received">Payment received</option>
                                                        </select>

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

            </div>
        </div>
    </div>

@endsection
