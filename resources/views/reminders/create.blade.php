@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Create Reminder</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reminders.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Appointment</label>

            <select name="appointment_id" class="form-select" required>

                <option value="">Select Appointment</option>

                @foreach($appointments as $appointment)

                    <option value="{{ $appointment->appointment_id }}">
                        #{{ $appointment->appointment_id }}
                        -
                        {{ $appointment->patient->first_name }}
                        {{ $appointment->patient->last_name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Reminder Date</label>

            <input
                type="date"
                name="reminder_date"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">Reminder Type</label>

            <select
                name="reminder_type"
                class="form-select"
                required>

                <option value="">Select Type</option>

                <option value="SMS">SMS</option>

                <option value="Email">Email</option>

                <option value="Call">Call</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">Reminder Status</label>

            <select
                name="reminder_status"
                class="form-select"
                required>

                <option value="">Select Status</option>

                <option value="Pending">Pending</option>

                <option value="Sent">Sent</option>

                <option value="Failed">Failed</option>

            </select>

        </div>

        <button class="btn btn-primary">
            Save Reminder
        </button>

        <a
            href="{{ route('reminders.index') }}"
            class="btn btn-secondary">

            Cancel

        </a>

    </form>

</div>

@endsection