@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>X-Ray Details</h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">X-Ray ID</th>
                <td>{{ $xray->xray_id }}</td>
            </tr>

            <tr>
                <th>Patient</th>
                <td>{{ $xray->record->appointment->patient->patient_name }}</td>
            </tr>

            <tr>
                <th>Dental Record</th>
                <td>{{ $xray->record_id }}</td>
            </tr>

            <tr>
                <th>X-Ray Type</th>
                <td>{{ $xray->xray_type }}</td>
            </tr>

            <tr>
                <th>X-Ray Date</th>
                <td>{{ $xray->xray_date }}</td>
            </tr>

            <tr>
                <th>File Path</th>
                <td>{{ $xray->file_path }}</td>
            </tr>

        </table>

        <a href="{{ route('xrays.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

</div>

@endsection