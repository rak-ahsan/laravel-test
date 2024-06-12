@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Withdrawal Transactions</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($withdrawals->isEmpty())
        <p>No withdrawals found.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Fee</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal->id }}</td>
                        <td>${{ number_format($withdrawal->amount, 2) }}</td>
                        <td>${{ number_format($withdrawal->fee, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($withdrawal->date)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
