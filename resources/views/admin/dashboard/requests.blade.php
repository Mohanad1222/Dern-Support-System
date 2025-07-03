@extends('layouts.dashboard-layout')
@section('nav-brand', 'Admin Dashboard')
@section('title', 'USER REQUESTS')

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage Requests</h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id</th>
                        <th class="px-6 py-4">user</th>
                        <th class="px-6 py-4">request title</th>
                        <th class="px-6 py-4">request description</th>
                        <th class="px-6 py-4">request status</th>
                        <th class="px-6 py-4">request creation time</th>
                        <th class="px-6 py-4">device</th>
                        <th class="px-6 py-4">payment</th>
                        <th class="px-6 py-4">feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $request->request_id }}</td>
                            <td class="px-6 py-4">
                                <a href="{{route('dashboard.users', ['user' => $request->user->id])}}" class="underline underline-offset-3 decoration-dotted">
                                    {{ $request->user->user_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $request->request_title }}</td>
                            <td class="px-6 py-4">{{ $request->request_description }}</td>
                            <td class="px-6 py-4">
                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-request-{{ $request->request_id }}">
                                    {{ $request->request_status }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                {{ $request->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-device-{{ $request->request_id }}">
                                    {{ $request->device->device_name }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-payment-{{ $request->request_id }}">
                                    {{ $request->payment->payment_amount }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#feedback-{{ $request->request_id }}">
                                    {{ $request->feedback->feedback_status == "given" ? $request->feedback->feedback_rate . ' / 10' : 'N/A'}}
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection

@push('modals')
    @foreach ($requests as $request)
        {{-- update request modal --}}
        <div class="modal fade" id="update-request-{{ $request->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Request</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form id="request-form-{{ $request->request_id }}" method="POST"
                            action="{{ route('requests.update', ['user_request' => $request->request_id]) }}"
                            class="space-y-4">
                            @csrf
                            @method('PUT')


                            <!-- Payment Method Dropdown -->
                            <input type="hidden" name="request_status"
                                id="request-status-value-{{ $request->request_id }}"
                                value="{{ $request->request_status }}">
                            <div class="relative custom-dropdown">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Request Status</label>
                                <button type="button" id="request-status-button-{{ $request->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md text-left">
                                    {{ ucfirst($request->request_status) ?? 'Select Status' }}
                                </button>
                                <ul id="request-status-options-{{ $request->request_id }}"
                                    class="hidden absolute w-full mt-1 rounded-lg bg-blue-500/10 border border-blue-400/30 backdrop-blur-md shadow-lg z-50 text-white">
                                    @foreach (['awating delivery', 'received', 'in progress', 'awaiting payment', 'completed'] as $status)
                                        <li data-value="{{ $status }}"
                                            class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">
                                            {{ ucfirst($status) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>



                        </form>

                        <!-- JS logic (should be inside the loop or dynamically repeated) -->
                        <script>
                            // PAYMENT METHOD dropdown
                            var requestStatusButton_{{ $request->request_id }} = document.getElementById(
                                'request-status-button-{{ $request->request_id }}');
                            var requestStatusOptions_{{ $request->request_id }} = document.getElementById(
                                'request-status-options-{{ $request->request_id }}');
                            var requestStatusInput_{{ $request->request_id }} = document.getElementById(
                                'request-status-value-{{ $request->request_id }}');

                            requestStatusButton_{{ $request->request_id }}.addEventListener('click', () => {
                                requestStatusOptions_{{ $request->request_id }}.classList.toggle('hidden');
                            });

                            requestStatusOptions_{{ $request->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value');
                                    requestStatusInput_{{ $request->request_id }}.value = value;
                                    requestStatusButton_{{ $request->request_id }}.textContent = option.textContent;
                                    requestStatusOptions_{{ $request->request_id }}.classList.add('hidden');
                                });
                            });


                            // Optional: hide both dropdowns when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!e.target.closest('.custom-dropdown')) {
                                    requestStatusOptions_{{ $request->request_id }}.classList.add('hidden');
                                }
                            });
                        </script>


                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            type="submit" form="request-form-{{ $request->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{-- update device modal --}}
        <div class="modal fade" id="update-device-{{ $request->device->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Device: {{ $request->device->device_name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form id="update-device-form-{{ $request->device->request_id }}" method="POST"
                            action="{{ route('devices.update', ['device' => $request->device->request_id]) }}">
                            @csrf
                            @method('PUT')

                            <label for="device_status" class="text-white mb-1 block">Device Status</label>

                            <input type="hidden" name="device_status"
                                id="device-status-value-{{ $request->device->request_id }}" value="{{ $request->device->device_status }}">

                            <div class="relative custom-dropdown">
                                <button type="button" id="device-status-button-{{ $request->device->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md">
                                    {{ ucfirst($request->device->device_status) ?? 'Select status' }}
                                </button>

                                <ul id="device-status-options-{{ $request->device->request_id }}"
                                    class="hidden absolute w-full mt-1 rounded-lg bg-blue-500/10 border border-blue-400/30 backdrop-blur-md shadow-lg z-50 text-white">
                                    <li data-value="awaiting delivery"
                                        class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">Awaiting Delivery
                                    </li>
                                    <li data-value="delivered"
                                        class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">Delivered</li>
                                    <li data-value="returned"
                                        class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">Returned</li>
                                </ul>
                            </div>
                        </form>



                        <script>
                            var deviceStatusButton_{{ $request->device->request_id }} = document.getElementById('device-status-button-{{ $request->device->request_id }}');
                            var deviceStatusOptions_{{ $request->device->request_id }} = document.getElementById('device-status-options-{{ $request->device->request_id }}');
                            var deviceStatusInput_{{ $request->device->request_id }} = document.getElementById(
                                'device-status-value-{{ $request->device->request_id }}');

                                deviceStatusButton_{{ $request->device->request_id }}.addEventListener('click', () => {
                                    deviceStatusOptions_{{ $request->device->request_id }}.classList.toggle('hidden');
                            });

                            deviceStatusOptions_{{ $request->device->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value'); // ✅ Get value from <li>
                                    deviceStatusInput_{{ $request->device->request_id }}.value = value;
                                    deviceStatusButton_{{ $request->device->request_id }}.textContent = option.textContent;
                                    deviceStatusOptions_{{ $request->device->request_id }}.classList.add('hidden');
                                });
                            });


                            // Optional: close dropdown when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!e.target.closest('.custom-dropdown')) {
                                    deviceStatusOptions_{{ $request->device->request_id }}.classList.add('hidden');
                                }
                            });
                        </script>

                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            type="submit" form="update-device-form-{{ $request->device->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{-- update payment modal --}}
        <div class="modal fade" id="update-payment-{{ $request->payment->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form id="payment-form-{{ $request->payment->request_id }}" method="POST"
                            action="{{ route('payments.update', ['payment' => $request->payment->request_id]) }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Payment Amount -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Amount</label>
                                <input type="number" name="payment_amount" value="{{ $request->payment->payment_amount }}"
                                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Payment Method Dropdown -->
                            <input type="hidden" name="payment_method"
                                id="payment-method-value-{{ $request->payment->request_id }}"
                                value="{{ $request->payment->payment_method }}">
                            <div class="relative custom-dropdown">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Method</label>
                                <button type="button" id="payment-method-button-{{ $request->payment->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md text-left">
                                    {{ ucfirst($request->payment->payment_method) ?? 'Select method' }}
                                </button>
                                <ul id="payment-method-options-{{ $request->payment->request_id }}"
                                    class="hidden absolute w-full mt-1 rounded-lg bg-blue-500/10 border border-blue-400/30 backdrop-blur-md shadow-lg z-50 text-white">
                                    @foreach (['cash', 'visa', 'mastercard', 'paypal', 'bank transfer'] as $method)
                                        <li data-value="{{ $method }}"
                                            class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">
                                            {{ ucfirst($method) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Payment Status Dropdown -->
                            <input type="hidden" name="payment_status"
                                id="payment-status-value-{{ $request->payment->request_id }}"
                                value="{{ $request->payment->payment_status }}">
                            <div class="relative custom-dropdown">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Status</label>
                                <button type="button" id="payment-status-button-{{ $request->payment->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md text-left">
                                    {{ ucfirst($request->payment->payment_status) ?? 'Select status' }}
                                </button>
                                <ul id="payment-status-options-{{ $request->payment->request_id }}"
                                    class="hidden absolute w-full mt-1 rounded-lg bg-blue-500/10 border border-blue-400/30 backdrop-blur-md shadow-lg z-50 text-white">
                                    @foreach (['awaiting payment', 'payment received'] as $status)
                                        <li data-value="{{ $status }}"
                                            class="px-4 py-2 hover:bg-blue-500/20 cursor-pointer transition">
                                            {{ ucfirst($status) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </form>

                        <!-- JS logic (should be inside the loop or dynamically repeated) -->
                        <script>
                            // PAYMENT METHOD dropdown
                            var paymentMethodButton_{{ $request->payment->request_id }} = document.getElementById('payment-method-button-{{ $request->payment->request_id }}');
                            var paymentMethodOptions_{{ $request->payment->request_id }} = document.getElementById('payment-method-options-{{ $request->payment->request_id }}');
                            var paymentMethodInput_{{ $request->payment->request_id }} = document.getElementById('payment-method-value-{{ $request->payment->request_id }}');
                        
                            paymentMethodButton_{{ $request->payment->request_id }}.addEventListener('click', () => {
                                paymentMethodOptions_{{ $request->payment->request_id }}.classList.toggle('hidden');
                            });
                        
                            paymentMethodOptions_{{ $request->payment->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value');
                                    paymentMethodInput_{{ $request->payment->request_id }}.value = value;
                                    paymentMethodButton_{{ $request->payment->request_id }}.textContent = option.textContent;
                                    paymentMethodOptions_{{ $request->payment->request_id }}.classList.add('hidden');
                                });
                            });
                        

                            // PAYMENT STATUS dropdown
                            var paymentStatusButton_{{ $request->payment->request_id }} = document.getElementById('payment-status-button-{{ $request->payment->request_id }}');
                            var paymentStatusOptions_{{ $request->payment->request_id }} = document.getElementById('payment-status-options-{{ $request->payment->request_id }}');
                            var paymentStatusInput_{{ $request->payment->request_id }} = document.getElementById('payment-status-value-{{ $request->payment->request_id }}');
                        
                            paymentStatusButton_{{ $request->payment->request_id }}.addEventListener('click', () => {
                                paymentStatusOptions_{{ $request->payment->request_id }}.classList.toggle('hidden');
                            });
                        
                            paymentStatusOptions_{{ $request->payment->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value');
                                    paymentStatusInput_{{ $request->payment->request_id }}.value = value;
                                    paymentStatusButton_{{ $request->payment->request_id }}.textContent = option.textContent;
                                    paymentStatusOptions_{{ $request->payment->request_id }}.classList.add('hidden');
                                });
                            });
                        
                            // Optional: hide both dropdowns when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!e.target.closest('.custom-dropdown')) {
                                    paymentMethodOptions_{{ $request->payment->request_id }}.classList.add('hidden');
                                    paymentStatusOptions_{{ $request->payment->request_id }}.classList.add('hidden');
                                }
                            });
                        </script>
                        
                        
                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            type="submit" form="payment-form-{{ $request->payment->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>

        {{-- feedback modal --}}
        <div class="modal fade" id="feedback-{{ $request->feedback->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Feedback</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">

                        <p><span class="font-semibold text-white">From:</span> {{ $request->feedback->request->user->user_name }}</p>
                        <p><span class="font-semibold text-white">Feedback status:</span> {{ $request->feedback->feedback_status }}</p>
                        <p><span class="font-semibold text-white">Submitted on:</span> {{ $request->feedback->feedback_status == "given" ? $request->feedback->updated_at : 'N/A'}}</p>
                        <p><span class="font-semibold text-white">Rate :</span> {{ $request->feedback->feedback_status == "given" ? $request->feedback->feedback_rate : 'N/A'}} / 10</p>
                        <p class="mt-3"><span class="font-semibold text-white">Message:</span></p>
                        <div class="bg-white/10 p-3 rounded-lg border border-white/10 text-white whitespace-pre-wrap">
                            {{ $request->feedback->feedback_status == "given" ? $request->feedback->feedback_text : 'N/A'}}
                        </div>                
        
                    </div>

                    <div class="modal-footer border-0">
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button
                            class="cursor-pointer px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                            type="submit" form="payment-form-{{ $request->payment->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
