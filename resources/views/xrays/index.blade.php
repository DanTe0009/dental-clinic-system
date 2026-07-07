@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">X-Rays</h2>

    <a href="{{ route('xrays.create') }}" class="btn btn-primary">
        + Add X-Ray
    </a>

</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow">

<div class="card-body">

<table class="table table-striped table-hover text-center align-middle">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Patient</th>
<th>X-Ray Type</th>
<th>Date</th>
<th width="260">Actions</th>

</tr>

</thead>

<tbody>

@forelse($xrays as $xray)

<tr>

<td>{{ $xray->xray_id }}</td>

<td>{{ $xray->record->appointment->patient->patient_name }}</td>

<td>{{ $xray->xray_type }}</td>

<td>{{ $xray->xray_date }}</td>

<td>

<div class="d-flex justify-content-center gap-2 flex-wrap">

<a href="{{ route('xrays.show',$xray->xray_id) }}"
class="btn btn-primary btn-sm">

Details

</a>

<a href="{{ route('xrays.edit',$xray->xray_id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form method="POST"
action="{{ route('xrays.destroy',$xray->xray_id) }}"
onsubmit="return confirm('Delete this X-Ray?')">

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

<td colspan="5">

No X-Rays found.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="d-flex justify-content-center">

{{ $xrays->links() }}

</div>

</div>

</div>

@endsection