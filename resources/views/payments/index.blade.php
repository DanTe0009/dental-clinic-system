@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Payments</h2>

        <a href="{{ route('payments.create') }}" class="btn btn-primary">
            Record Payment
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-primary">

            <tr>

                <th>ID</th>
                <th>Patient</th>
                <th>Invoice</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
                <th>Method</th>
                <th width="280">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($payments as $payment)

            <tr>

                <td>{{ $payment->payment_id }}</td>

                <td>
                    {{ $payment->invoice->record->appointment->patient->patient_name }}
                </td>

                <td>
                    #{{ $payment->invoice_id }}
                </td>

                <td>
                    {{ $payment->amount_paid }}
                </td>

                <td>
                    {{ $payment->payment_date }}
                </td>

                <td>
                    {{ $payment->payment_method }}
                </td>

                <td class="text-nowrap">

                    <a href="{{ route('payments.show', $payment->payment_id) }}"
                       class="btn btn-info btn-sm">
                        View
                    </a>

                    <a href="{{ route('payments.edit', $payment->payment_id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('payments.destroy', $payment->payment_id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this payment?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" class="text-center">
                    No payments found.
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="mt-3">

        {{ $payments->links() }}

    </div>

</div>

@endsection