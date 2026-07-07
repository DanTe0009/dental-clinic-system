@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">Dental Records</h2>

    <a href="{{ route('records.create') }}" class="btn btn-primary">
        + Add Record
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
                    <th>Dentist</th>
                    <th>Date</th>
                    <th width="260">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($records as $record)

                <tr>

                    <td>{{ $record->record_id }}</td>

                    <td>{{ $record->appointment->patient->patient_name }}</td>

                    <td>{{ $record->appointment->dentist->dentist_name }}</td>

                    <td>{{ $record->created_date }}</td>

                    <td>

                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <a href="{{ route('records.show',$record->record_id) }}"
                               class="btn btn-primary btn-sm">

                                Details

                            </a>

                            <a href="{{ route('records.edit',$record->record_id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('records.destroy',$record->record_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this record?')">

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

                        No records found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{ $records->links() }}

        </div>

    </div>

</div>

@endsection