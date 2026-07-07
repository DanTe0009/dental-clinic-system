@extends('layouts.app')

@section('content')

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Add Prescription</h3>

</div>

<div class="card-body">

<form method="POST"
action="{{ route('prescriptions.store') }}">

@csrf

<div class="mb-3">

<label>Dental Record</label>

<select name="record_id"
class="form-select">

@foreach($records as $record)

<option value="{{ $record->record_id }}">

Record #{{ $record->record_id }}

-

{{ $record->appointment->patient->patient_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Medicine Name</label>

<input
type="text"
name="medicine_name"
class="form-control">

</div>

<div class="mb-3">

<label>Dosage</label>

<input
type="text"
name="dosage"
class="form-control">

</div>

<div class="mb-3">

<label>Frequency</label>

<input
type="text"
name="frequency"
class="form-control">

</div>

<div class="mb-3">

<label>Duration (Days)</label>

<input
type="number"
name="duration_days"
class="form-control">

</div>

<button class="btn btn-success">

Save

</button>

<a href="{{ route('prescriptions.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

@endsection