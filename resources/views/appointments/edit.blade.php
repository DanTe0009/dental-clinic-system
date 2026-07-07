@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h3>Edit Appointment</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('appointments.update',$appointment->appointment_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Patient</label>

                <select name="patient_id" class="form-select">

                    @foreach($patients as $patient)

                        <option
                            value="{{ $patient->patient_id }}"
                            {{ $appointment->patient_id==$patient->patient_id ? 'selected' : '' }}>

                            {{ $patient->patient_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Dentist</label>

                <select name="dentist_id" class="form-select">

                    @foreach($dentists as $dentist)

                        <option
                            value="{{ $dentist->dentist_id }}"
                            {{ $appointment->dentist_id==$dentist->dentist_id ? 'selected' : '' }}>

                            {{ $dentist->dentist_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Date</label>

                <input
                    type="date"
                    name="appointment_date"
                    class="form-control"
                    value="{{ $appointment->appointment_date }}">

            </div>

            <div class="mb-3">

                <label class="form-label">Time</label>

                <input
                    type="time"
                    name="appointment_time"
                    class="form-control"
                    value="{{ $appointment->appointment_time }}">

            </div>

            <div class="mb-3">

                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="Booked"
                        {{ $appointment->status=="Booked" ? "selected" : "" }}>
                        Booked
                    </option>

                    <option value="Cancelled"
                        {{ $appointment->status=="Cancelled" ? "selected" : "" }}>
                        Cancelled
                    </option>

                    <option value="Rescheduled"
                        {{ $appointment->status=="Rescheduled" ? "selected" : "" }}>
                        Rescheduled
                    </option>

                </select>

            </div>

            <button class="btn btn-success">

                Update Appointment

            </button>

            <a href="{{ route('appointments.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection