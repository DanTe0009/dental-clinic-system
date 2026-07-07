@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Prescription Details</h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Prescription ID</th>
                <td>{{ $prescription->prescription_id }}</td>
            </tr>

            <tr>
                <th>Patient</th>
                <td>{{ $prescription->record->appointment->patient->patient_name }}</td>
            </tr>

            <tr>
                <th>Medicine</th>
                <td>{{ $prescription->medicine_name }}</td>
            </tr>

            <tr>
                <th>Dosage</th>
                <td>{{ $prescription->dosage }}</td>
            </tr>

            <tr>
                <th>Frequency</th>
                <td>{{ $prescription->frequency }}</td>
            </tr>

            <tr>
                <th>Duration</th>
                <td>{{ $prescription->duration_days }} day(s)</td>
            </tr>

        </table>

        <a href="{{ route('prescriptions.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@endsection