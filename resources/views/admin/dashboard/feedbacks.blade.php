@extends('layouts.main')

@section('title', 'Feedbacks')

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
                    <x-tabs.tab route="dashboard.devices" text="Devices" />
                    <x-tabs.tab route="dashboard.payments" text="Payments" />
                    <x-tabs.tab route="dashboard.feedbacks" text="Feedbacks" :isActive="true" />

                </div>
            </div>

            <div class="col-md-10">
                
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Request/feedback ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">feedback Rate</th>
                                <th scope="col">feedback Text</th>                
                                <th scope="col">feedback Status</th>                
                                <th scope="col">feedback Date</th>                
                            </tr>
                        </thead>
                        <tbody>
                
                            @foreach ($feedbacks as $feedback)
                                <tr class="align-middle">
                                    <th scope="row">{{ $feedback->request_id }}</th>
                                    <th><a href="{{route('dashboard.users', ["user" => $feedback->request->user->id])}}">{{ $feedback->request->user->user_name }}</a></th>
                                    <td>{{ $feedback->feedback_rate }}/10</td>
                                    <td>{{ $feedback->feedback_text }}</td>
                                    <td>{{ $feedback->feedback_status }}</td>
                                    <td>{{ $feedback->feedback_status=="given" ? $feedback->updated_at : "Not given yet" }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>

@endsection
