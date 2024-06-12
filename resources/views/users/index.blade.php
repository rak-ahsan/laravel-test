@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-12">
            <h2>Your Current Balance: ${{ number_format($balance, 2) }}</h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h3>Your Transactions</h3>
            @if($transactions->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No transactions found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ ucfirst($transaction->transaction_type) }}</td>
                                    <td>${{ number_format($transaction->amount, 2) }}</td>
                                    <td>${{ number_format($transaction->fee, 2) }}</td>
                                    <td>{{ $transaction->date->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
