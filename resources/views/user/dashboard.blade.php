@extends('layouts.main')

@section('title', 'Dashboard')

@section('main')

    <h1>USER DASHBOARD</h1>
    <a href="{{route('user.request.form')}}" class="btn btn-primary">JG</a>



    <div class="container-fluid mt-5">
        <div class="row g-0">
            <!-- Tabs (Left Side) -->
            <div class="col-md-2">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <x-tabs.tab name="my-requests" text="My Requests" :isActive="true" />
                    <x-tabs.tab name="my-devices" text="My Devices"/>
                    <x-tabs.tab name="my-payments" text="My Payments"/>
                    <x-tabs.tab name="my-feedbacks" text="My Feedback"/>

                </div>
            </div>

            <!-- Tab Content (Right Side) -->
            <div class="col-md-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <x-tabs.tab-content name="my-requests" :isActive="true">
                        @foreach ($requests as $request)
                            <h1>{{ $request->request_title }} {{ $request->request_description }} {{ $request->request_status }} {{$request->created_at}}</h1>
                        @endforeach
                    </x-tabs.tab-content>

                    <x-tabs.tab-content name="my-devices">
                        @foreach ($requests as $request)
                            <h1>{{ $request->device->device_name }} {{ $request->device->device_status }}</h1>
                        @endforeach
                    </x-tabs.tab-content>

                    <x-tabs.tab-content name='my-payments'>
                        @foreach ($requests as $request)
                            <h1>{{ $request->payment->payment_amount }} {{ $request->payment->payment_method }} {{ $request->payment->payment_status}}</h1>
                        @endforeach
                    </x-tabs.tab-content>

                    <x-tabs.tab-content name='my-feedbacks'>
                        @foreach ($requests as $request)
                            <h1>{{ $request->feedback->feedback_rate }} {{ $request->feedback->feedback_text }} {{ $request->feedback->feedback_status}}</h1>
                        @endforeach
                    </x-tabs.tab-content>

                </div>
            </div>
        </div>
    </div>




@endsection