@extends('layouts.main')

@section('title', 'Users')

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

                    <x-tabs.tab route="dashboard.users" text="Users" :isActive="true"/>
                    <x-tabs.tab route="dashboard.technicians" text="Technicians" />
                    <x-tabs.tab route="dashboard.requests" text="Requests"/>
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <!-- Tab Content (Right Side) -->
            <div class="col-md-10">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Role</th>
                            <th scope="col">Requests</th>
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="align-middle">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->requests->count() }}</td>
                            <td>
                                <a href="{{route('dashboard.users', ['user'=>$user->id])}}" class="btn btn-primary">Details</a>
                                <button class="btn btn-danger"  {{$user->role=='admin' ? 'disabled' : ''}} data-bs-toggle="modal" data-bs-target="#delete-modal-{{$user->id}}">
                                    Delete
                                </button>
        
                                <div class="modal fade" id="delete-modal-{{$user->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{route('users.delete', ['user' => $user->id])}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <h4>Are you sure you want to delete this user, This action is not reversible and will delete all their requests.</h4>
                                                    <input type="submit" value="Delete">
                                                </form>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
