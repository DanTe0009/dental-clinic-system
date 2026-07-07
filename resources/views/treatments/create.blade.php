@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Add Treatment</h3>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('treatments.store') }}">

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

                <label>Treatment Name</label>

                <input
                    type="text"
                    name="treatment_name"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Cost</label>

                <input
                    type="number"
                    step="0.01"
                    name="treatment_cost"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Treatment Date</label>

                <input
                    type="date"
                    name="treatment_date"
                    class="form-control">

            </div>

            <button class="btn btn-success">
                Save
            </button>

            <a href="{{ route('treatments.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection