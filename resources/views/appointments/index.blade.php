@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">Appointments</h2>

    <a href="{{ route('appointments.create') }}" class="btn btn-primary">
        + New Appointment
    </a>

</div>

<form method="GET" action="{{ route('appointments.index') }}" class="mb-4">

    <div class="input-group">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search patient, dentist or status..."
            value="{{ $search }}">

        <button class="btn btn-primary">
            Search
        </button>

    </div>

</form>

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover text-center align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Patient</th>
<th>Dentist</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th width="260">Actions</th>

</tr>

</thead>

<tbody>

@forelse($appointments as $appointment)

<tr>

<td>{{ $appointment->appointment_id }}</td>

<td>{{ $appointment->patient->patient_name }}</td>

<td>{{ $appointment->dentist->dentist_name }}</td>

<td>{{ $appointment->appointment_date }}</td>

<td>{{ $appointment->appointment_time }}</td>

<td>

@if($appointment->status=="Booked")

<span class="badge bg-success">Booked</span>

@elseif($appointment->status=="Cancelled")

<span class="badge bg-danger">Cancelled</span>

@else

<span class="badge bg-warning text-dark">Rescheduled</span>

@endif

</td>

<td>

    <div class="d-flex justify-content-center gap-2 flex-wrap">

        <a href="{{ route('appointments.show',$appointment->appointment_id) }}"
           class="btn btn-primary btn-sm">
            Details
        </a>

        <a href="{{ route('appointments.edit',$appointment->appointment_id) }}"
           class="btn btn-warning btn-sm">
            Edit
        </a>

        <form
            action="{{ route('appointments.destroy',$appointment->appointment_id) }}"
            method="POST"
            onsubmit="return confirm('Delete this appointment?');">

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

<td colspan="7">

No appointments found.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="d-flex justify-content-center">

{{ $appointments->withQueryString()->links() }}

</div>

</div>

</div>

@endsection