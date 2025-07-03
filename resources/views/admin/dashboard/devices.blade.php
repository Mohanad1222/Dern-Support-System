@extends('layouts.dashboard-layout')
@section('title', 'USER DEVICES')

@section('main')


    @foreach ($errors->all() as $error)
        <h1>{{ $error }}</h1>
    @endforeach


    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-white mb-6">Manage devices</h1>

        </div>

        <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-lg border border-white/10">
            <table class="min-w-full text-sm text-left text-gray-200">
                <thead class="text-xs uppercase text-gray-400 bg-white/10">
                    <tr>
                        <th class="px-6 py-4"># id (request/device)</th>
                        <th class="px-6 py-4">device owner</th>
                        <th class="px-6 py-4">device name</th>
                        <th class="px-6 py-4">device status</th>
                        <th class="px-6 py-4">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr class="border-b border-white/10 hover:bg-white/5 transition">
                            <td class="px-6 py-4">{{ $device->request_id }}</td>
                            <td>
                                <a href="{{route('dashboard.users', ['user' => $device->request->user->id])}}" class="underline underline-offset-3 decoration-dotted">
                                    {{ $device->request->user->user_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">{{ $device->device_name }}</td>
                            <td class="px-6 py-4">{{ $device->device_status }}</td>
                            <td class="px-6 py-4">

                                <button
                                    class="px-3 py-1 rounded-lg bg-blue-500/20 text-white hover:bg-blue-500/30 transition"
                                    data-bs-toggle="modal" data-bs-target="#update-modal-{{ $device->request_id }}">
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
    @foreach ($devices as $device)
        <div class="modal fade" id="update-modal-{{ $device->request_id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-[#111827] text-white !border-blue-500 border shadow-lg">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-blue-300">Update Device: {{ $device->device_name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body text-sm text-gray-300">
                        <form id="update-form-{{ $device->request_id }}" method="POST"
                            action="{{ route('devices.update', ['device' => $device->request_id]) }}">
                            @csrf
                            @method('PUT')

                            <label for="device_status" class="text-white mb-1 block">Device Status</label>

                            <input type="hidden" name="device_status" id="device-status-value-{{ $device->request_id }}"
                                value="{{ $device->device_status }}">

                            <div class="relative custom-dropdown">
                                <button type="button" id="dropdown-button-{{ $device->request_id }}"
                                    class="w-full px-4 py-2 rounded-lg bg-blue-500/10 text-white border border-blue-400/30 hover:bg-blue-500/20 transition backdrop-blur-md">
                                    {{ ucfirst($device->device_status) ?? 'Select status' }}
                                </button>

                                <ul id="dropdown-options-{{ $device->request_id }}"
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
                            var button_{{ $device->request_id }} = document.getElementById('dropdown-button-{{ $device->request_id }}');
                            var options_{{ $device->request_id }} = document.getElementById('dropdown-options-{{ $device->request_id }}');
                            var hiddenInput_{{ $device->request_id }} = document.getElementById(
                                'device-status-value-{{ $device->request_id }}');

                            button_{{ $device->request_id }}.addEventListener('click', () => {
                                options_{{ $device->request_id }}.classList.toggle('hidden');
                            });

                            options_{{ $device->request_id }}.querySelectorAll('li').forEach(option => {
                                option.addEventListener('click', () => {
                                    const value = option.getAttribute('data-value'); // ✅ Get value from <li>
                                    hiddenInput_{{ $device->request_id }}.value = value;
                                    button_{{ $device->request_id }}.textContent = option.textContent;
                                    options_{{ $device->request_id }}.classList.add('hidden');
                                });
                            });


                            // Optional: close dropdown when clicking outside
                            document.addEventListener('click', (e) => {
                                if (!e.target.closest('.custom-dropdown')) {
                                    options_{{ $device->request_id }}.classList.add('hidden');
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
                            type="submit" form="update-form-{{ $device->request_id }}">
                            Update
                        </button>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
