@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h3>Edit Schedule</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('schedules.update',$schedule->schedule_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Dentist</label>

                <select name="dentist_id" class="form-select">

                    @foreach($dentists as $dentist)

                        <option value="{{ $dentist->dentist_id }}"
                            {{ $schedule->dentist_id==$dentist->dentist_id ? 'selected' : '' }}>

                            {{ $dentist->dentist_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Date</label>

                <input type="date"
                       name="available_date"
                       class="form-control"
                       value="{{ $schedule->available_date }}">

            </div>

            <div class="mb-3">

                <label>Start Time</label>

                <input type="time"
                       name="start_time"
                       class="form-control"
                       value="{{ $schedule->start_time }}">

            </div>

            <div class="mb-3">

                <label>End Time</label>

                <input type="time"
                       name="end_time"
                       class="form-control"
                       value="{{ $schedule->end_time }}">

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="is_available" class="form-select">

                    <option value="1"
                        {{ $schedule->is_available ? 'selected' : '' }}>
                        Available
                    </option>

                    <option value="0"
                        {{ !$schedule->is_available ? 'selected' : '' }}>
                        Unavailable
                    </option>

                </select>

            </div>

            <button class="btn btn-success">
                Update Schedule
            </button>

            <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection