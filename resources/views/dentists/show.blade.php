@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">
        Dentist Details
    </h2>

    <a href="{{ route('dentists.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            {{ $dentist->dentist_name }}
        </h4>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <strong>Dentist ID</strong>
                <p>{{ $dentist->dentist_id }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Phone</strong>
                <p>{{ $dentist->phone }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Email</strong>
                <p>{{ $dentist->email }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>License Number</strong>
                <p>{{ $dentist->license_number }}</p>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Years of Experience</strong>
                <p>{{ $dentist->years_experience }} Years</p>
            </div>

        </div>

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">
            Specializations
        </h5>

    </div>

    <div class="card-body">

        @forelse($dentist->specializations as $specialization)

            <span class="badge bg-success fs-6 me-2 mb-2">
                {{ $specialization->specialization_name }}
            </span>

        @empty

            <p class="text-muted mb-0">
                No specializations assigned.
            </p>

        @endforelse

    </div>

</div>

<div class="card shadow mb-4">

    <div class="card-header bg-info text-white">

        <h5 class="mb-0">
            Available Schedule
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse($dentist->schedules as $schedule)

                <tr>

                    <td>{{ $schedule->available_date }}</td>

                    <td>{{ $schedule->start_time }}</td>

                    <td>{{ $schedule->end_time }}</td>

                    <td>

                        @if($schedule->is_available)

                            <span class="badge bg-success">
                                Available
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Not Available
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">
                        No schedule available.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@php

$total=$dentist->appointments->count();

$booked=$dentist->appointments->where('status','Booked')->count();

$cancelled=$dentist->appointments->where('status','Cancelled')->count();

$rescheduled=$dentist->appointments->where('status','Rescheduled')->count();

@endphp

<div class="card shadow mb-4">

    <div class="card-header bg-warning">

        <h5 class="mb-0">
            Appointment Statistics
        </h5>

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3">

                <div class="alert alert-primary">

                    <h4>{{ $total }}</h4>

                    Total

                </div>

            </div>

            <div class="col-md-3">

                <div class="alert alert-success">

                    <h4>{{ $booked }}</h4>

                    Booked

                </div>

            </div>

            <div class="col-md-3">

                <div class="alert alert-danger">

                    <h4>{{ $cancelled }}</h4>

                    Cancelled

                </div>

            </div>

            <div class="col-md-3">

                <div class="alert alert-warning">

                    <h4>{{ $rescheduled }}</h4>

                    Rescheduled

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow">

    <div class="card-header bg-secondary text-white">

        <h5 class="mb-0">
            Appointment History
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-striped table-hover">

            <thead>

            <tr>

                <th>ID</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @forelse($dentist->appointments as $appointment)

                <tr>

                    <td>{{ $appointment->appointment_id }}</td>

                    <td>{{ $appointment->patient->patient_name ?? 'N/A' }}</td>

                    <td>{{ $appointment->appointment_date }}</td>

                    <td>{{ $appointment->appointment_time }}</td>

                    <td>

                        @if($appointment->status=='Booked')

                            <span class="badge bg-success">
                                Booked
                            </span>

                        @elseif($appointment->status=='Cancelled')

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                Rescheduled
                            </span>

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