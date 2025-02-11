@extends('layouts.main')


@section('title', 'Dashboard')

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

                    <x-tabs.tab name="users" text="Users" :isActive="true" />
                    <x-tabs.tab name="technicians" text="Technicians"/>

                </div>
            </div>

            <!-- Tab Content (Right Side) -->
            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <x-tabs.tab-content name="users" :isActive="true">
                        @foreach ($users as $user)
                            <h1>{{ $user->user_name }} {{ $user->user_password }} {{ $user->role }}</h1>
                        @endforeach
                    </x-tabs.tab-content>

                    <x-tabs.tab-content name="technicians">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add Technician Account
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('technician.register')}}" method="post">
                                            @csrf
                                            <input type="text" name="technician_name" placeholder="tech name">
                                            <input type="text" name="technician_password" placeholder="tech password">
                                            <input type="text" name="technician_password_confirmation" placeholder="tech password confirm">
                                            <input type="submit" value="SUMBIT">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @foreach ($technicians as $technician)
                            <h1>{{ $technician->technician_name }} {{ $technician->technician_password }}</h1>
                        @endforeach
                    </x-tabs.tab-content>


                </div>
            </div>
        </div>
    </div>


@endsection
