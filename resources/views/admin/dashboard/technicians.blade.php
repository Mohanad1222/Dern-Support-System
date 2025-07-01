@extends('layouts.dashboard-layout')
@section('nav-brand', 'Admin Dashboard')
@section('title', 'Technicians')

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage Technicians</h1>
            <button class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                data-bs-toggle="modal" data-bs-target="#create-technician-modal">
                Add Technician
            </button>
        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id</th>
                        <th class="px-6 py-4">technician name</th>
                        <th class="px-6 py-4">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technicians as $technician)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $technician->technician_id }}</td>
                            <td class="px-6 py-4">{{ $technician->technician_name }}</td>
                            <td class="px-6 py-4">

                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-modal-{{ $technician->technician_id }}">
                                    Update
                                </button>

                                <button class="px-3 py-1 rounded-lg bg-red-500/20 text-white hover:bg-red-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $technician->technician_id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- <div class="container-fluid mt-5">



        <div class="row g-0">
            <!-- Tabs (Left Side) -->
            <div class="col-md-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <x-tabs.tab route="dashboard.users" text="Users" />
                    <x-tabs.tab route="dashboard.technicians" text="Technicians" :isActive="true" />
                    <x-tabs.tab route="dashboard.requests" text="Requests" />
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <!-- Tab Content (Right Side) -->
            <div class="col-md-10">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
                    Add a technician
                </button>

                <div class="modal fade" id="create-modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{ route('technician.register') }}" method="post">
                                    @csrf
                                    <input type="text" name="technician_name" placeholder="TECHNICAIN NAME">
                                    <input type="password" name="technician_password" placeholder="TECHNICAIN password">
                                    <input type="submit" value="SUBMIT">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Technician Name</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technicians as $technician)
                            <tr class="align-middle">
                                <th scope="row">{{ $technician->technician_id }}</th>
                                <td>{{ $technician->technician_name }}</td>
                                <td>
                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#update-modal-{{ $technician->technician_id }}">
                                        UPDATE
                                    </button>

                                    <div class="modal fade" id="update-modal-{{ $technician->technician_id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('dashboard.technicians.update', ['technician' => $technician->technician_id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="text" name="technician_name"
                                                            placeholder="TECHNICAIN NAME"
                                                            value="{{ $technician->technician_name }}">
                                                        <input type="password" name="technician_password"
                                                            placeholder="TECHNICAIN password">
                                                        <input type="submit" value="SUBMIT">
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-modal-{{ $technician->technician_id }}">
                                        DELETE
                                    </button>

                                    <div class="modal fade" id="delete-modal-{{ $technician->technician_id }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('technician.delete', ['technician' => $technician]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <h1>Are You sure you want to Delete?</h1>
                                                        <input type="submit" value="Confirm">
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
    </div> --}}


@endsection
@push('modals')
<div class="modal fade" id="create-technician-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title text-blue-300">Add Technician</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body text-sm text-gray-300">
                <form
                    action="{{ route('technician.register')}}"
                    method="post" 
                    id="create-technician-form">
                    @csrf
                    <label for="tech-name" class="block text-sm font-medium text-gray-300 mb-1">
                        Technician Name
                    </label>
                    <input id="tech-name" type="text" name="technician_name" placeholder="Enter New Name..."
                        class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white placeholder-gray-400 border !border-blue-500/20 focus:outline-none focus:ring-2 focus:ring-blue-500 transition mb-2">

                    <label for="tech-pass" class="block text-sm font-medium text-gray-300 mb-1">
                        Technician Password
                    </label>
                    <input id="tech-pass" type="password" name="technician_password"
                        placeholder="Enter New Password..."
                        class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white placeholder-gray-400 border !border-blue-500/20 focus:outline-none focus:ring-2 focus:ring-blue-500 transition mb-2">


                </form>
            </div>

            <div class="modal-footer border-0">
                <button
                    class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                    data-bs-dismiss="modal">
                    Cancel
                </button>
                <button
                    class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                    type="submit" form="create-technician-form">
                    Create
                </button>

            </div>
        </div>
    </div>
</div>

    @foreach ($technicians as $technician)
        <div class="modal fade" id="update-modal-{{ $technician->technician_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Technician: {{ $technician->technician_name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form
                            action="{{ route('dashboard.technicians.update', ['technician' => $technician->technician_id]) }}"
                            method="post" id="update-form-{{ $technician->technician_id }}">
                            @csrf
                            @method('PUT')
                            <label for="tech-name" class="block text-sm font-medium text-gray-300 mb-1">
                                Technician Name
                            </label>
                            <input id="tech-name" type="text" name="technician_name" placeholder="Enter New Name..."
                                value="{{ $technician->technician_name }}"
                                class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white placeholder-gray-400 border !border-blue-500/20 focus:outline-none focus:ring-2 focus:ring-blue-500 transition mb-2">

                            <label for="tech-pass" class="block text-sm font-medium text-gray-300 mb-1">
                                Technician Password
                            </label>
                            <input id="tech-pass" type="password" name="technician_password"
                                placeholder="Enter New Password..."
                                class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white placeholder-gray-400 border !border-blue-500/20 focus:outline-none focus:ring-2 focus:ring-blue-500 transition mb-2">


                        </form>
                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-red-500/20 text-white hover:bg-red-500/30 transition"
                            type="submit" form="update-form-{{ $technician->technician_id }}">
                            Confirm
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-modal-{{ $technician->technician_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Confirm Deletion</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        Are you sure you want to delete this technician? This action is <strong class="text-red-400">not
                            reversible</strong>.
                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="{{ route('technician.delete', ['technician' => $technician->technician_id]) }}"
                            method="post">
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
