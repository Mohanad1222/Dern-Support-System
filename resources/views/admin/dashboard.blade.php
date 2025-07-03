@extends('layouts.dashboard-layout')

@section('title', 'Dashboard')

@section('main')
    <div class="px-6 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Dashboard Overview</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Users Box -->
            <div class="rounded-xl bg-white/5 border border-white/10 backdrop-blur p-6 shadow-md">
                <h2 class="text-lg font-semibold text-white mb-2">Users</h2>
                <p class="text-3xl font-bold text-blue-400">{{ $totalUsers }}</p>
                <div class="mt-4 space-y-1 text-sm text-gray-300">
                    <p>New Today: <span class="text-white font-medium">{{ $newUsersToday }}</span></p>
                    <p>New This Month: <span class="text-white font-medium">{{ $newUsersMonth }}</span></p>
                    <p>New This Year: <span class="text-white font-medium">{{ $newUsersYear }}</span></p>
                </div>
            </div>

            <!-- Requests Box -->
            <div class="rounded-xl bg-white/5 border border-white/10 backdrop-blur p-6 shadow-md">
                <h2 class="text-lg font-semibold text-white mb-2">Requests</h2>
                <p class="text-3xl font-bold text-green-400">{{ $totalRequests }}</p>
                <div class="mt-4 space-y-1 text-sm text-gray-300">
                    <p>Completed: <span class="text-white font-medium">{{ $completedRequests }}</span></p>
                    <p>Pending: <span class="text-white font-medium">{{ $pendingRequests }}</span></p>
                </div>
            </div>

            <!-- Technicians Box -->
            <div class="rounded-xl bg-white/5 border border-white/10 backdrop-blur p-6 shadow-md">
                <h2 class="text-lg font-semibold text-white mb-2">Technicians</h2>
                <p class="text-3xl font-bold text-yellow-400">{{ $totalTechnicians }}</p>

            </div>

            <!-- Feedbacks Box -->
            <div class="rounded-xl bg-white/5 border border-white/10 backdrop-blur p-6 shadow-md">
                <h2 class="text-lg font-semibold text-white mb-2">Feedbacks</h2>
                <p class="text-3xl font-bold text-pink-400">{{ $totalFeedbacks }}</p>
                <div class="mt-4 space-y-1 text-sm text-gray-300">
                    <p>Average Rating: <span class="text-white font-medium">{{ $averageRating }}/10</span></p>
                </div>
            </div>

            <!-- Payments Box -->
            <div class="rounded-xl bg-white/5 border border-white/10 backdrop-blur p-6 shadow-md">
                <h2 class="text-lg font-semibold text-white mb-2">Payments</h2>
                <p class="text-3xl font-bold text-emerald-400">${{ $totalPayments }}</p>
                <div class="mt-4 space-y-1 text-sm text-gray-300">
                    <p>Paid: <span class="text-white font-medium">{{ $paymentsReceived }} (${{ $paymentsAmountReceived }})</span></p>
                    <p>Pending: <span class="text-white font-medium">{{ $paymentsPending }} (${{ $paymentsAmountPending }})</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
