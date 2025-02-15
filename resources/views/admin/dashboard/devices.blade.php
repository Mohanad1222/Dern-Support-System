@extends('layouts.main')

@section('title', 'USER DEVICES')

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
                    <x-tabs.tab route="dashboard.requests" text="Requests" />
                    <x-tabs.tab route="dashboard.devices" text="Devices" :isActive="true" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <div class="col-md-10">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Request/Device ID</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">Device Name</th>
                            <th scope="col">Device Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($devices as $device)
                            <tr class="align-middle">
                                <th scope="row">{{ $device->request_id }}</th>
                                <th><a
                                        href="{{ route('dashboard.users', ['user' => $device->request->user->id]) }}">{{ $device->request->user->user_name }}</a>
                                </th>
                                <td>{{ $device->device_name }}</td>
                                <td>{{ $device->device_status }}</td>
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#device-modal-{{ $device->request_id }}">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="device-modal-{{ $device->request_id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h4>
                                                        Device Name: {{ $device->device_name }}
                                                    </h4>
                                                    <form
                                                        action="{{ route('devices.update', ['device' => $device->request_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <label for="device_status">Device Status:</label>
                                                        <select id="device_status" name="device_status">
                                                            <option
                                                                {{ $device->device_status == 'awaiting delivery' ? 'selected' : '' }}
                                                                value="awaiting delivery">Awaiting Delivery</option>
                                                            <option
                                                                {{ $device->device_status == 'delivered' ? 'selected' : '' }}
                                                                value="delivered">Delivered</option>
                                                            <option
                                                                {{ $device->device_status == 'returned' ? 'selected' : '' }}
                                                                value="returned">Returned</option>
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
