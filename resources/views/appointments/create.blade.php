@extends('layouts.app')

@section('content')

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Create Appointment</h3>

</div>

<div class="card-body">

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('appointments.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Patient</label>

<select name="patient_id" class="form-select" required>

<option value="">Select Patient</option>

@foreach($patients as $patient)

<option value="{{ $patient->patient_id }}">

{{ $patient->patient_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">Dentist</label>

<select name="dentist_id" class="form-select" required>

<option value="">Select Dentist</option>

@foreach($dentists as $dentist)

<option value="{{ $dentist->dentist_id }}">

{{ $dentist->dentist_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Date</label>

<input
type="date"
name="appointment_date"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Time</label>

<input
type="time"
name="appointment_time"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option>Booked</option>

<option>Cancelled</option>

<option>Rescheduled</option>

</select>

</div>

</div>

<button class="btn btn-success">

Save Appointment

</button>

<a href="{{ route('appointments.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

@endsection