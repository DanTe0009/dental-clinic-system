@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h3>Edit Treatment</h3>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('treatments.update',$treatment->treatment_id) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Dental Record</label>

                <select
                    name="record_id"
                    class="form-select">

                    @foreach($records as $record)

                        <option
                            value="{{ $record->record_id }}"
                            {{ $record->record_id==$treatment->record_id ? 'selected' : '' }}>

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
                    class="form-control"
                    value="{{ $treatment->treatment_name }}">

            </div>

            <div class="mb-3">

                <label>Cost</label>

                <input
                    type="number"
                    step="0.01"
                    name="treatment_cost"
                    class="form-control"
                    value="{{ $treatment->treatment_cost }}">

            </div>

            <div class="mb-3">

                <label>Treatment Date</label>

                <input
                    type="date"
                    name="treatment_date"
                    class="form-control"
                    value="{{ $treatment->treatment_date }}">

            </div>

            <button class="btn btn-success">

                Update Treatment

            </button>

            <a href="{{ route('treatments.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection