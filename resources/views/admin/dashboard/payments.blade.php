@extends('layouts.dashboard-layout')
@section('title', 'PAYMENTS')
@section('nav-brand', 'Admin Dashboard')
@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach


    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage payments</h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id (request/payment)</th>
                        <th class="px-6 py-4">user name</th>
                        <th class="px-6 py-4">payment amount</th>
                        <th class="px-6 py-4">payment method</th>
                        <th class="px-6 py-4">payment status</th>
                        <th class="px-6 py-4">payment date</th>
                        <th class="px-6 py-4">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $payment->request_id }}</td>
                            <td class="px-6 py-4"> <a
                                    href="{{ route('dashboard.users', ['user' => $payment->request->user->id]) }}"
                                    class="underline underline-offset-3 decoration-dotted">
                                    {{ $payment->request->user->user_name }}
                                </a></td>
                            <td class="px-6 py-4">{{ $payment->payment_amount }}</td>
                            <td class="px-6 py-4">{{ $payment->payment_method }}</td>
                            <td class="px-6 py-4">{{ $payment->payment_status }}</td>
                            <td class="px-6 py-4">
                                {{ $payment->payment_status == 'payment received' ? $payment->updated_at : 'Not paid yet' }}
                            </td>
                            <td class="px-6 py-4">

                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-payment-{{ $payment->request_id }}">
                                    Update
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
    @foreach ($payments as $payment)
        <div class="modal fade" id="update-payment-{{ $payment->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Payment</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form id="payment-form-{{ $payment->request_id }}" method="POST"
                            action="{{ route('payments.update', ['payment' => $payment->request_id]) }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Payment Amount -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Amount</label>
                                <input type="number" name="payment_amount" value="{{ $payment->payment_amount }}"
                                    class="w-full px-4 py-2 rounded-lg bg-white/10 text-white placeholder-gray-400 border border-white/20 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Payment Method Dropdown -->
                            <input type="hidden" name="payment_method"
                                id="payment-method-value-{{ $payment->request_id }}"
                                value="{{ $payment->payment_method }}">
                            <div class="relative custom-dropdown">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Method</label>
                                <button type="button" id="method-button-{{ $payment->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md text-left">
                                    {{ ucfirst($payment->payment_method) ?? 'Select method' }}
                                </button>
                                <ul id="method-options-{{ $payment->request_id }}"
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
                                id="payment-status-value-{{ $payment->request_id }}"
                                value="{{ $payment->payment_status }}">
                            <div class="relative custom-dropdown">
                                <label class="block text-sm font-medium text-gray-300 mb-1">Payment Status</label>
                                <button type="button" id="status-button-{{ $payment->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md text-left">
                                    {{ ucfirst($payment->payment_status) ?? 'Select status' }}
                                </button>
                                <ul id="status-options-{{ $payment->request_id }}"
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
                            var methodButton_{{ $payment->request_id }} = document.getElementById('method-button-{{ $payment->request_id }}');
                            var methodOptions_{{ $payment->request_id }} = document.getElementById(
                                'method-options-{{ $payment->request_id }}');
                            var methodInput_{{ $payment->request_id }} = document.getElementById(
                                'payment-method-value-{{ $payment->request_id }}');

                            methodButton_{{ $payment->request_id }}.addEventListener('click', () => {
                                methodOptions_{{ $payment->request_id }}.classList.toggle('hidden');
                            });

                            methodOptions_{{ $payment->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value');
                                    methodInput_{{ $payment->request_id }}.value = value;
                                    methodButton_{{ $payment->request_id }}.textContent = option.textContent;
                                    methodOptions_{{ $payment->request_id }}.classList.add('hidden');
                                });
                            });

                            // PAYMENT STATUS dropdown
                            var statusButton_{{ $payment->request_id }} = document.getElementById('status-button-{{ $payment->request_id }}');
                            var statusOptions_{{ $payment->request_id }} = document.getElementById(
                                'status-options-{{ $payment->request_id }}');
                            var statusInput_{{ $payment->request_id }} = document.getElementById(
                                'payment-status-value-{{ $payment->request_id }}');

                            statusButton_{{ $payment->request_id }}.addEventListener('click', () => {
                                statusOptions_{{ $payment->request_id }}.classList.toggle('hidden');
                            });

                            statusOptions_{{ $payment->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value');
                                    statusInput_{{ $payment->request_id }}.value = value;
                                    statusButton_{{ $payment->request_id }}.textContent = option.textContent;
                                    statusOptions_{{ $payment->request_id }}.classList.add('hidden');
                                });
                            });

                            // Optional: hide both dropdowns when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!e.target.closest('.custom-dropdown')) {
                                    methodOptions_{{ $payment->request_id }}.classList.add('hidden');
                                    statusOptions_{{ $payment->request_id }}.classList.add('hidden');
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
                            type="submit" form="payment-form-{{ $payment->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
