@extends('layouts.app')

@section('content')

<div class="container">

    <h2>Reminder Details</h2>

    <table class="table table-bordered">

        <tr>
            <th>Appointment</th>
            <td>{{ $reminder->appointment_id }}</td>
        </tr>

        <tr>
            <th>Patient</th>
            <td>{{ $reminder->appointment->patient->patient_name }}</td>
        </tr>

        <tr>
            <th>Reminder Date</th>
            <td>{{ $reminder->reminder_date }}</td>
        </tr>

        <tr>
            <th>Type</th>
            <td>{{ $reminder->reminder_type }}</td>
        </tr>

        <tr>
            <th>Status</th>
            <td>{{ $reminder->reminder_status }}</td>
        </tr>

    </table>

    <a href="{{ route('reminders.index') }}" class="btn btn-secondary">
        Back
    </a>

</div>

@endsection