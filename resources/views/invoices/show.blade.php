@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Invoice Details</h2>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="220">Invoice ID</th>
                    <td>{{ $invoice->invoice_id }}</td>
                </tr>

                <tr>
                    <th>Patient</th>
                    <td>{{ $invoice->record->appointment->patient->full_name }}</td>
                </tr>

                <tr>
                    <th>Dental Record ID</th>
                    <td>{{ $invoice->record_id }}</td>
                </tr>

                <tr>
                    <th>Generated Date</th>
                    <td>{{ $invoice->generated_date }}</td>
                </tr>

                <tr>
                    <th>Due Date</th>
                    <td>{{ $invoice->due_date }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $invoice->status }}</td>
                </tr>

            </table>

            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                Back
            </a>

        </div>
    </div>

</div>

@endsection