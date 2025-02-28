@extends('layouts.dashboard-layout')

@section('nav-brand', 'Admin Dashboard')
@section('title', 'Dashboard')

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
                    <x-tabs.tab route="dashboard.technicians" text="Technicians" />
                    <x-tabs.tab route="dashboard.requests" text="Requests" />
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" />

                </div>
            </div>

            <!-- Tab Content (Right Side) -->
            <div class="col-md-10">

            </div>
        </div>
    </div>


@endsection
