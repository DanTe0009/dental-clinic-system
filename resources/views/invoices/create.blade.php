@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Generate Invoice</h2>

        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
            Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($records->isEmpty())

        <div class="alert alert-info">
            <strong>All dental records already have invoices.</strong><br>
            Every Dental Record in the database already has its corresponding Invoice, so a new invoice cannot be created.
        </div>

    @else

        <form action="{{ route('invoices.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Dental Record</label>

                <select name="record_id" class="form-select" required>

                    <option value="">Select Dental Record</option>

                    @foreach($records as $record)
                        <option value="{{ $record->record_id }}">
                            Record #{{ $record->record_id }}
                            -
                            {{ $record->appointment->patient->patient_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Generated Date</label>

                <input
                    type="date"
                    name="generated_date"
                    class="form-control"
                    value="{{ old('generated_date') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Due Date</label>

                <input
                    type="date"
                    name="due_date"
                    class="form-control"
                    value="{{ old('due_date') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>

                <select name="status" class="form-select" required>
                    <option value="Unpaid">Unpaid</option>
                    <option value="Partial">Partial</option>
                    <option value="Paid">Paid</option>
                </select>
            </div>

            <button class="btn btn-primary">
                Generate Invoice
            </button>

        </form>

    @endif

</div>

@endsection