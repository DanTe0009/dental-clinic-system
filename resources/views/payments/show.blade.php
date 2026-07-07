@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Payment Details</h2>

    <table class="table table-bordered">

        <tr>
            <th width="220">Payment ID</th>
            <td>{{ $payment->payment_id }}</td>
        </tr>

        <tr>
            <th>Patient</th>
            <td>{{ $payment->invoice->record->appointment->patient->patient_name }}</td>
        </tr>

        <tr>
            <th>Invoice</th>
            <td>#{{ $payment->invoice_id }}</td>
        </tr>

        <tr>
            <th>Amount Paid</th>
            <td>{{ $payment->amount_paid }}</td>
        </tr>

        <tr>
            <th>Payment Date</th>
            <td>{{ $payment->payment_date }}</td>
        </tr>

        <tr>
            <th>Payment Method</th>
            <td>{{ $payment->payment_method }}</td>
        </tr>

    </table>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

@endsection