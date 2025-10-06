@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-cog"></i> Settings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('settings.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-money-bill-wave"></i> Currency Settings
                            </h5>
                            
                            <div class="mb-3">
                                <label for="currency" class="form-label fw-bold">Default Currency</label>
                                <p class="text-muted small mb-2">Select your preferred currency for displaying amounts</p>
                                <select name="currency" id="currency" class="form-select form-select-lg" required>
                                    <option value="">Select Currency</option>
                                    @foreach($currencies as $code => $name)
                                        <option value="{{ $code }}" 
                                            {{ $user->currency == $code ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('currency')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="fas fa-eye"></i> Preview
                                    </h6>
                                    <p class="mb-1">Current format: 
                                        <span class="fw-bold" id="currencyPreview">
                                            {{ $user->currency }} - 
                                            @if($user->currency == 'USD')$@elseif($user->currency == 'EUR')€@elseif($user->currency == 'GBP')£@elseif($user->currency == 'JPY')¥@elseif($user->currency == 'INR')₹@elseif($user->currency == 'PHP')₱@elseif($user->currency == 'PKR')₨@elseif($user->currency == 'BDT')৳@else{{ $user->currency }}@endif
                                        </span>
                                    </p>
                                    <p class="mb-0 text-muted small">Example: 
                                        <span id="currencyExample">
                                            @if($user->currency == 'USD')$@elseif($user->currency == 'EUR')€@elseif($user->currency == 'GBP')£@elseif($user->currency == 'JPY')¥@elseif($user->currency == 'INR')₹@elseif($user->currency == 'PHP')₱@elseif($user->currency == 'PKR')₨@elseif($user->currency == 'BDT')৳@else{{ $user->currency }}@endif
                                            1,000.00
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary me-md-2">
                                <i class="fas fa-arrow-left"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currencySelect = document.getElementById('currency');
    const currencyPreview = document.getElementById('currencyPreview');
    const currencyExample = document.getElementById('currencyExample');
    
    const currencySymbols = {
        'USD': '$', 'EUR': '€', 'GBP': '£', 'JPY': '¥', 
        'CAD': 'C$', 'AUD': 'A$', 'INR': '₹', 'CNY': '¥',
        'PHP': '₱', 'PKR': '₨', 'BDT': '৳', 'LKR': 'Rs',
        'NPR': 'Rs', 'MVR': 'Rf', 'BTN': 'Nu', 'MYR': 'RM',
        'SGD': 'S$', 'IDR': 'Rp', 'THB': '฿', 'VND': '₫',
        'KRW': '₩'
    };
    
    const currencyNames = {
        'USD': 'US Dollar', 'EUR': 'Euro', 'GBP': 'British Pound', 
        'JPY': 'Japanese Yen', 'CAD': 'Canadian Dollar', 
        'AUD': 'Australian Dollar', 'INR': 'Indian Rupee', 
        'CNY': 'Chinese Yuan', 'PHP': 'Philippine Peso', 
        'PKR': 'Pakistani Rupee', 'BDT': 'Bangladeshi Taka',
        'LKR': 'Sri Lankan Rupee', 'NPR': 'Nepalese Rupee',
        'MVR': 'Maldivian Rufiyaa', 'BTN': 'Bhutanese Ngultrum',
        'MYR': 'Malaysian Ringgit', 'SGD': 'Singapore Dollar',
        'IDR': 'Indonesian Rupiah', 'THB': 'Thai Baht',
        'VND': 'Vietnamese Dong', 'KRW': 'South Korean Won'
    };
    
    currencySelect.addEventListener('change', function() {
        const selectedCurrency = this.value;
        const symbol = currencySymbols[selectedCurrency] || selectedCurrency;
        const name = currencyNames[selectedCurrency] || selectedCurrency;
        
        currencyPreview.textContent = `${selectedCurrency} - ${name}`;
        currencyExample.textContent = `${symbol} 1,000.00`;
    });
});
</script>
@endsection