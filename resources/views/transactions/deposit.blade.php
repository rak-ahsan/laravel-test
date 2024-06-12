@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Make a Deposit</h1>
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('deposit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Deposit Amount</label>
            <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required>
            @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Deposit</button>
    </form>
</div>
@endsection

