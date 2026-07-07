@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">Invoices</h2>

    <a href="{{ route('invoices.create') }}" class="btn btn-primary">
        + Generate Invoice
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover text-center align-middle">

<thead class="table-primary">

<tr>

    <th>ID</th>
    <th>Patient</th>
    <th>Generated</th>
    <th>Due Date</th>
    <th>Status</th>
    <th width="260">Actions</th>

</tr>

</thead>

<tbody>

@forelse($invoices as $invoice)

<tr>

    <td>{{ $invoice->invoice_id }}</td>

    <td>{{ $invoice->record->appointment->patient->patient_name }}</td>

    <td>{{ $invoice->generated_date }}</td>

    <td>{{ $invoice->due_date }}</td>

    <td>

    @if($invoice->status=="Paid")

        <span class="badge bg-success">
            {{ $invoice->status }}
        </span>

    @elseif($invoice->status=="Partial")

        <span class="badge bg-warning text-dark">
            {{ $invoice->status }}
        </span>

    @else

        <span class="badge bg-danger">
            {{ $invoice->status }}
        </span>

    @endif

</td>

    <td>

        <div class="d-flex justify-content-center gap-2 flex-wrap">

            <a href="{{ route('invoices.show',$invoice->invoice_id) }}"
               class="btn btn-primary btn-sm">

                Details

            </a>

            <a href="{{ route('invoices.edit',$invoice->invoice_id) }}"
               class="btn btn-warning btn-sm">

                Edit

            </a>

            <form
                method="POST"
                action="{{ route('invoices.destroy',$invoice->invoice_id) }}"
                onsubmit="return confirm('Delete this invoice?')">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">

                    Delete

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="6">

        No invoices found.

    </td>

</tr>

@endforelse

</tbody>

</table>

<div class="d-flex justify-content-center">

{{ $invoices->links() }}

</div>

</div>

</div>

@endsection