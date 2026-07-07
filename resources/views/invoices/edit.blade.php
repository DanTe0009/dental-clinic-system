@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Edit Invoice</h2>

    <form action="{{ route('invoices.update', $invoice->invoice_id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Dental Record</label>

            <select name="record_id" class="form-select" required>

                @foreach($records as $record)

                    <option value="{{ $record->record_id }}"
                        {{ $record->record_id == $invoice->record_id ? 'selected' : '' }}>

                        Record #{{ $record->record_id }}
                        -
                        {{ $record->appointment->patient->full_name }}

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
                value="{{ $invoice->generated_date }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Due Date</label>

            <input
                type="date"
                name="due_date"
                class="form-control"
                value="{{ $invoice->due_date }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>

            <select name="status" class="form-select" required>

                <option value="Unpaid"
                    {{ $invoice->status == 'Unpaid' ? 'selected' : '' }}>
                    Unpaid
                </option>

                <option value="Partial"
                    {{ $invoice->status == 'Partial' ? 'selected' : '' }}>
                    Partial
                </option>

                <option value="Paid"
                    {{ $invoice->status == 'Paid' ? 'selected' : '' }}>
                    Paid
                </option>

            </select>

        </div>

        <button type="submit" class="btn btn-warning">
            Update Invoice
        </button>

        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection