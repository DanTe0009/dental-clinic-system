@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Dental Record Details</h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Record ID</th>
                <td>{{ $record->record_id }}</td>
            </tr>

            <tr>
                <th>Patient</th>
                <td>{{ $record->appointment->patient->patient_name }}</td>
            </tr>

            <tr>
                <th>Dentist</th>
                <td>{{ $record->appointment->dentist->dentist_name }}</td>
            </tr>

            <tr>
                <th>Appointment Date</th>
                <td>{{ $record->appointment->appointment_date }}</td>
            </tr>

            <tr>
                <th>Created Date</th>
                <td>{{ $record->created_date }}</td>
            </tr>

            <tr>
                <th>Allergies</th>
                <td>{{ $record->allergies ?: 'None' }}</td>
            </tr>

            <tr>
                <th>Medical History</th>
                <td>{{ $record->medical_history ?: 'N/A' }}</td>
            </tr>

        </table>

        <hr>

        <h4>Treatments</h4>

        @if($record->treatments->count())

            <ul>

                @foreach($record->treatments as $treatment)

                    <li>

                        {{ $treatment->treatment_name }}

                        (Rs. {{ number_format($treatment->treatment_cost,2) }})

                    </li>

                @endforeach

            </ul>

        @else

            <p>No treatments recorded.</p>

        @endif

        <hr>

        <h4>Prescriptions</h4>

        @if($record->prescriptions->count())

            <ul>

                @foreach($record->prescriptions as $prescription)

                    <li>

                        {{ $prescription->medicine_name }}

                        -

                        {{ $prescription->dosage }}

                    </li>

                @endforeach

            </ul>

        @else

            <p>No prescriptions.</p>

        @endif

        <hr>

        <h4>X-Rays</h4>

        @if($record->xrays->count())

            <ul>

                @foreach($record->xrays as $xray)

                    <li>

                        {{ $xray->xray_type }}

                        |

                        {{ $xray->xray_date }}

                    </li>

                @endforeach

            </ul>

        @else

            <p>No X-Rays.</p>

        @endif

        <hr>

        <h4>Invoice</h4>

        @if($record->invoice)

            <p>

                Invoice Status:

                <strong>{{ $record->invoice->status }}</strong>

            </p>

        @else

            <p>No invoice generated.</p>

        @endif

        <a href="{{ route('records.index') }}"
           class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@endsection