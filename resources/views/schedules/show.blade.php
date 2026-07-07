@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h3>Schedule Details</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="220">Schedule ID</th>
                <td>{{ $schedule->schedule_id }}</td>
            </tr>

            <tr>
                <th>Dentist</th>
                <td>{{ $schedule->dentist->dentist_name }}</td>
            </tr>

            <tr>
                <th>Available Date</th>
                <td>{{ $schedule->available_date }}</td>
            </tr>

            <tr>
                <th>Start Time</th>
                <td>{{ $schedule->start_time }}</td>
            </tr>

            <tr>
                <th>End Time</th>
                <td>{{ $schedule->end_time }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($schedule->is_available)
                        <span class="badge bg-success">Available</span>
                    @else
                        <span class="badge bg-danger">Unavailable</span>
                    @endif
                </td>
            </tr>

        </table>

        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

</div>

@endsection