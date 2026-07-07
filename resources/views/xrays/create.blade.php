@extends('layouts.app')

@section('content')

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3>Add X-Ray</h3>

</div>

<div class="card-body">

<form method="POST"
action="{{ route('xrays.store') }}">

@csrf

<div class="mb-3">

<label>Dental Record</label>

<select name="record_id" class="form-select">

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

<label>File Path</label>

<input
type="text"
name="file_path"
class="form-control"
placeholder="e.g. xrays/xray001.jpg">

</div>

<div class="mb-3">

<label>X-Ray Type</label>

<input
type="text"
name="xray_type"
class="form-control"
placeholder="e.g. Bitewing, Panoramic">

</div>

<div class="mb-3">

<label>X-Ray Date</label>

<input
type="date"
name="xray_date"
class="form-control">

</div>

<button class="btn btn-success">

Save

</button>

<a href="{{ route('xrays.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

@endsection