@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">Patient Details</h2>

    <a href="{{ route('patients.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            {{ $patient->patient_name }}
        </h4>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <strong>Patient ID</strong>
                <p>{{ $patient->patient_id }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Age</strong>
                <p>{{ $patient->age }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Gender</strong>
                <p>{{ $patient->gender }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Phone</strong>
                <p>{{ $patient->phone }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Email</strong>
                <p>{{ $patient->email }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Street</strong>
                <p>{{ $patient->street }}</p>
            </div>

            <div class="col-md-4 mb-3">
                <strong>City</strong>
                <p>{{ $patient->city }}</p>
            </div>

            <div class="col-md-4 mb-3">
                <strong>State</strong>
                <p>{{ $patient->state }}</p>
            </div>

            <div class="col-md-4 mb-3">
                <strong>Registration Date</strong>
                <p>{{ $patient->registration_date }}</p>
            </div>

            <div class="col-12">
                <strong>Emergency Contact</strong>
                <p>{{ $patient->emergency_contact }}</p>
            </div>

        </div>

    </div>

</div>

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Appointment History
        </h4>

    </div>

    <div class="card-body">

        @php
            $booked = $patient->appointments->where('status','Booked')->count();
            $cancelled = $patient->appointments->where('status','Cancelled')->count();
            $rescheduled = $patient->appointments->where('status','Rescheduled')->count();
        @endphp

        <div class="row text-center mb-4">

            <div class="col-md-3">
                <div class="alert alert-primary">
                    <h5>{{ $patient->appointments->count() }}</h5>
                    <strong>Total</strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert alert-success">
                    <h5>{{ $booked }}</h5>
                    <strong>Booked</strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert alert-danger">
                    <h5>{{ $cancelled }}</h5>
                    <strong>Cancelled</strong>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert alert-warning">
                    <h5>{{ $rescheduled }}</h5>
                    <strong>Rescheduled</strong>
                </div>
            </div>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-light">

            <tr>

                <th>ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Dentist</th>
                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse($patient->appointments as $appointment)

                <tr>

                    <td>{{ $appointment->appointment_id }}</td>

                    <td>{{ $appointment->appointment_date }}</td>

                    <td>{{ $appointment->appointment_time }}</td>

                    <td>{{ $appointment->dentist->dentist_name ?? 'N/A' }}</td>

                    <td>

                        @if($appointment->status=='Booked')
                            <span class="badge bg-success">Booked</span>

                        @elseif($appointment->status=='Cancelled')
                            <span class="badge bg-danger">Cancelled</span>

                        @else
                            <span class="badge bg-warning text-dark">Rescheduled</span>
                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">
                        No appointments found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection