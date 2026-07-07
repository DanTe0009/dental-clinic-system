@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="fw-bold">Patients</h2>

    <a href="{{ route('patients.create') }}" class="btn btn-primary">
        + Add Patient
    </a>

</div>

<form method="GET" action="{{ route('patients.index') }}" class="mb-4">

    <div class="input-group">

        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search..."
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
                <th>Age</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Email</th>
                <th>City</th>
                <th width="260">Actions</th>
            </tr>

            </thead>

            <tbody>

            @forelse($patients as $patient)

                <tr>

                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->patient_name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->city }}</td>

                    <td>

                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">

                            <a href="{{ route('patients.show', $patient->patient_id) }}"
                               class="btn btn-info btn-sm">
                                <i class="bi bi-person-vcard"></i> View
                            </a>

                            <a href="{{ route('patients.edit', $patient->patient_id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('patients.destroy', $patient->patient_id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this patient?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8">
                        No patients found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{ $patients->withQueryString()->links() }}

        </div>

    </div>

</div>

@endsection