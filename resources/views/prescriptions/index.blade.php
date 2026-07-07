@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">Prescriptions</h2>

    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary">
        + Add Prescription
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
<th>Medicine</th>
<th>Dosage</th>
<th>Frequency</th>
<th width="260">Actions</th>

</tr>

</thead>

<tbody>

@forelse($prescriptions as $prescription)

<tr>

<td>{{ $prescription->prescription_id }}</td>

<td>{{ $prescription->record->appointment->patient->patient_name }}</td>

<td>{{ $prescription->medicine_name }}</td>

<td>{{ $prescription->dosage }}</td>

<td>{{ $prescription->frequency }}</td>

<td>

<div class="d-flex justify-content-center gap-2 flex-wrap">

<a href="{{ route('prescriptions.show',$prescription->prescription_id) }}"
class="btn btn-primary btn-sm">

Details

</a>

<a href="{{ route('prescriptions.edit',$prescription->prescription_id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form
method="POST"
action="{{ route('prescriptions.destroy',$prescription->prescription_id) }}"
onsubmit="return confirm('Delete this prescription?')">

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

<td colspan="6">

No prescriptions found.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="d-flex justify-content-center">

{{ $prescriptions->links() }}

</div>

</div>

</div>

@endsection