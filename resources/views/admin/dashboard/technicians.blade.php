@extends('layouts.dashboard-layout')
@section('nav-brand', 'Admin Dashboard')
@section('title', 'Technicians')

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach
    <div class="container-fluid mt-5">

    

        <div class="row g-0">
            <!-- Tabs (Left Side) -->
            <div class="col-md-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <x-tabs.tab route="dashboard.users" text="Users" />
                    <x-tabs.tab route="dashboard.technicians" text="Technicians" :isActive="true" />
                    <x-tabs.tab route="dashboard.requests" text="Requests"/>
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
                                <form action="{{route('technician.register')}}" method="post">
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
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-modal-{{$technician->technician_id}}">
                                    UPDATE
                                </button>
        
                                <div class="modal fade" id="update-modal-{{$technician->technician_id}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{route('dashboard.technicians.update', ['technician' => $technician->technician_id])}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" name="technician_name" placeholder="TECHNICAIN NAME" value="{{$technician->technician_name}}">
                                                    <input type="password" name="technician_password" placeholder="TECHNICAIN password">
                                                    <input type="submit" value="SUBMIT">
                                                </form>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$technician->technician_id}}">
                                    DELETE
                                </button>
        
                                <div class="modal fade" id="delete-modal-{{$technician->technician_id}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{route('technician.delete', ['technician' => $technician])}}" method="post">
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
    </div>


@endsection
