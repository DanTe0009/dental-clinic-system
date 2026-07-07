@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h3>Edit X-Ray</h3>

    </div>

    <div class="card-body">

        <form method="POST"
              action="{{ route('xrays.update',$xray->xray_id) }}">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Dental Record</label>

                <select name="record_id" class="form-select">

                    @foreach($records as $record)

                        <option value="{{ $record->record_id }}"
                            {{ $record->record_id == $xray->record_id ? 'selected' : '' }}>

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
                    value="{{ $xray->file_path }}">

            </div>

            <div class="mb-3">

                <label>X-Ray Type</label>

                <input
                    type="text"
                    name="xray_type"
                    class="form-control"
                    value="{{ $xray->xray_type }}">

            </div>

            <div class="mb-3">

                <label>X-Ray Date</label>

                <input
                    type="date"
                    name="xray_date"
                    class="form-control"
                    value="{{ $xray->xray_date }}">

            </div>

            <button class="btn btn-success">

                Update X-Ray

            </button>

            <a href="{{ route('xrays.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection