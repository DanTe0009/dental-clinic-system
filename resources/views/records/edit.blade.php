@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h3>Edit Dental Record</h3>

    </div>

    <div class="card-body">

        <form action="{{ route('records.update',$record->record_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Appointment</label>

                <select
                    name="appointment_id"
                    class="form-select">

                    @foreach($appointments as $appointment)

                        <option
                            value="{{ $appointment->appointment_id }}"
                            {{ $record->appointment_id==$appointment->appointment_id ? 'selected' : '' }}>

                            #{{ $appointment->appointment_id }}

                            |

                            {{ $appointment->patient->patient_name }}

                            |

                            {{ $appointment->dentist->dentist_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Created Date</label>

                <input
                    type="date"
                    name="created_date"
                    class="form-control"
                    value="{{ $record->created_date }}">

            </div>

            <div class="mb-3">

                <label>Allergies</label>

                <input
                    type="text"
                    name="allergies"
                    class="form-control"
                    value="{{ $record->allergies }}">

            </div>

            <div class="mb-3">

                <label>Medical History</label>

                <textarea
                    name="medical_history"
                    class="form-control"
                    rows="4">{{ $record->medical_history }}</textarea>

            </div>

            <button class="btn btn-success">

                Update Record

            </button>

            <a href="{{ route('records.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection