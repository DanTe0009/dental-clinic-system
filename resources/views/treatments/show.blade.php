@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Treatment Details</h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Treatment ID</th>
                <td>{{ $treatment->treatment_id }}</td>
            </tr>

            <tr>
                <th>Patient</th>
                <td>{{ $treatment->record->appointment->patient->patient_name }}</td>
            </tr>

            <tr>
                <th>Treatment</th>
                <td>{{ $treatment->treatment_name }}</td>
            </tr>

            <tr>
                <th>Cost</th>
                <td>Rs. {{ number_format($treatment->treatment_cost,2) }}</td>
            </tr>

            <tr>
                <th>Date</th>
                <td>{{ $treatment->treatment_date }}</td>
            </tr>

        </table>

        <a href="{{ route('treatments.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@endsection