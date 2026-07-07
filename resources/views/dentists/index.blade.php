@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">
        Dentists
    </h2>

    <a href="{{ route('dentists.create') }}"
       class="btn btn-primary">

        + Add Dentist

    </a>

</div>

<form method="GET"
      action="{{ route('dentists.index') }}"
      class="mb-4">

    <div class="input-group">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search dentist..."
            value="{{ $search }}">

        <button class="btn btn-primary">
            Search
        </button>

    </div>

</form>

<div class="card shadow-sm">

<div class="card-body">

<table class="table table-striped table-hover align-middle text-center">

<thead class="table-primary">

<tr>

<th>ID</th>
<th>Name</th>
<th>Phone</th>
<th>Email</th>
<th>License</th>
<th>Experience</th>
<th width="260">Actions</th>

</tr>

</thead>

<tbody>

@forelse($dentists as $dentist)

<tr>

<td>{{ $dentist->dentist_id }}</td>

<td>{{ $dentist->dentist_name }}</td>

<td>{{ $dentist->phone }}</td>

<td>{{ $dentist->email }}</td>

<td>{{ $dentist->license_number }}</td>

<td>{{ $dentist->years_experience }} Years</td>

<td>

<div class="d-flex justify-content-center gap-2 flex-wrap">

<a href="{{ route('dentists.show',$dentist->dentist_id) }}"
class="btn btn-info btn-sm">

<i class="bi bi-person-vcard"></i>

View

</a>

<a href="{{ route('dentists.edit',$dentist->dentist_id) }}"
class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

Edit

</a>

<form
action="{{ route('dentists.destroy',$dentist->dentist_id) }}"
method="POST"
class="d-inline"
onsubmit="return confirm('Delete this dentist?')">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">

<i class="bi bi-trash"></i>

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="7">

No dentists found.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="d-flex justify-content-center">

{{ $dentists->withQueryString()->links() }}

</div>

</div>

</div>

@endsection