@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold">Schedules</h2>

    <a href="{{ route('schedules.create') }}" class="btn btn-primary">
        + Add Schedule
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>

@endif

<div class="card shadow">

    <div class="card-body">

        <table class="table table-striped table-hover align-middle text-center">

            <thead class="table-primary">

                <tr>

                    <th>ID</th>
                    <th>Dentist</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th width="260">Actions</th>

                </tr>

            </thead>

            <tbody>

            @forelse($schedules as $schedule)

                <tr>

                    <td>{{ $schedule->schedule_id }}</td>

                    <td>{{ $schedule->dentist->dentist_name }}</td>

                    <td>{{ $schedule->available_date }}</td>

                    <td>{{ $schedule->start_time }}</td>

                    <td>{{ $schedule->end_time }}</td>

                    <td>

                        @if($schedule->is_available)

                            <span class="badge bg-success">Available</span>

                        @else

                            <span class="badge bg-danger">Unavailable</span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <a href="{{ route('schedules.show',$schedule->schedule_id) }}"
                               class="btn btn-primary btn-sm">
                                Details
                            </a>

                            <a href="{{ route('schedules.edit',$schedule->schedule_id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('schedules.destroy',$schedule->schedule_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this schedule?')">

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

                    <td colspan="7">

                        No schedules found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">

            {{ $schedules->links() }}

        </div>

    </div>

</div>

@endsection