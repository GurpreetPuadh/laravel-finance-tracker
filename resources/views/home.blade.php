@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5><i class="fas fa-wallet"></i> Total Balance</h5>
                    <h3>{{ format_currency($totalBalance) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5><i class="fas fa-arrow-up"></i> Total Income</h5>
                   <h3>{{ format_currency($totalIncome) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5><i class="fas fa-arrow-down"></i> Total Expenses</h5>
                    <h3>{{ format_currency($totalExpenses) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Income vs Expenses</h5>
                </div>
                <div class="card-body">
                    <canvas id="financeChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Transactions</h5>
                </div>
                <div class="card-body">
                    @foreach($recentTransactions as $transaction)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $transaction->category }}</strong>
                            <br>
                            <small class="text-muted">{{ $transaction->description }}</small>
                        </div>
                        <div class="text-end">
                            <span class="{{ $transaction->type == 'income' ? 'income' : 'expense' }}">
                                {{ $transaction->type == 'income' ? '+' : '-' }}{{ format_currency($transaction->amount) }}
                            </span>
                            <br>
                            <small>{{ $transaction->date->format('M d, Y') }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    fetch('{{ route("chart.data") }}')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('financeChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Income', 'Expenses'],
                    datasets: [{
                        data: [{{ $totalIncome }}, {{ $totalExpenses }}],
                        backgroundColor: ['#28a745', '#dc3545']
                    }]
                }
            });
        });
</script>
@endsection