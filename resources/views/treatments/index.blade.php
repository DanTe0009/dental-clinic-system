@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">Treatments</h2>

    <a href="{{ route('treatments.create') }}" class="btn btn-primary">
        + Add Treatment
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
                    <th>Treatment</th>
                    <th>Cost</th>
                    <th>Date</th>
                    <th width="260">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($treatments as $treatment)

                <tr>

                    <td>{{ $treatment->treatment_id }}</td>

                    <td>{{ $treatment->record->appointment->patient->patient_name }}</td>

                    <td>{{ $treatment->treatment_name }}</td>

                    <td>Rs. {{ number_format($treatment->treatment_cost,2) }}</td>

                    <td>{{ $treatment->treatment_date }}</td>

                    <td>

                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <a href="{{ route('treatments.show',$treatment->treatment_id) }}"
                               class="btn btn-primary btn-sm">
                                Details
                            </a>

                            <a href="{{ route('treatments.edit',$treatment->treatment_id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('treatments.destroy',$treatment->treatment_id) }}"
                                  onsubmit="return confirm('Delete this treatment?')">

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
                        No treatments found.
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{ $treatments->links() }}

        </div>

    </div>

</div>

@endsection