@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Deposit Transactions</h1>
    @if($deposits->isEmpty())
        <div class="alert alert-warning" role="alert">
            No deposit transactions found.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <th scope="row">{{ $deposit->id }}</th>
                            <td>${{ number_format($deposit->amount, 2) }}</td>
                            <td>{{ $deposit->date->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
