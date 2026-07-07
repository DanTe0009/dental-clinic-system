@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h3>Appointment Details</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Appointment ID</th>
                <td>{{ $appointment->appointment_id }}</td>
            </tr>

            <tr>
                <th>Patient</th>
                <td>{{ $appointment->patient->patient_name }}</td>
            </tr>

            <tr>
                <th>Dentist</th>
                <td>{{ $appointment->dentist->dentist_name }}</td>
            </tr>

            <tr>
                <th>Date</th>
                <td>{{ $appointment->appointment_date }}</td>
            </tr>

            <tr>
                <th>Time</th>
                <td>{{ $appointment->appointment_time }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <span class="badge bg-primary">

                        {{ $appointment->status }}

                    </span>

                </td>
            </tr>

            @if($appointment->status=="Booked" && $appointment->booked)

            <tr>
                <th>Confirmation No</th>
                <td>{{ $appointment->booked->confirmation_no }}</td>
            </tr>

            <tr>
                <th>Booked On</th>
                <td>{{ $appointment->booked->booked_on }}</td>
            </tr>

            @endif

            @if($appointment->status=="Cancelled" && $appointment->cancelled)

            <tr>
                <th>Cancellation Reason</th>
                <td>{{ $appointment->cancelled->cancellation_reason }}</td>
            </tr>

            <tr>
                <th>Cancelled By</th>
                <td>{{ $appointment->cancelled->cancelled_by }}</td>
            </tr>

            <tr>
                <th>Cancelled On</th>
                <td>{{ $appointment->cancelled->cancelled_on }}</td>
            </tr>

            @endif

            @if($appointment->status=="Rescheduled" && $appointment->rescheduled)

            <tr>
                <th>Original Date</th>
                <td>{{ $appointment->rescheduled->original_date }}</td>
            </tr>

            <tr>
                <th>Original Time</th>
                <td>{{ $appointment->rescheduled->original_time }}</td>
            </tr>

            <tr>
                <th>Reason</th>
                <td>{{ $appointment->rescheduled->reschedule_reason }}</td>
            </tr>

            @endif

        </table>

        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">

            Back

        </a>

    </div>

</div>

@endsection