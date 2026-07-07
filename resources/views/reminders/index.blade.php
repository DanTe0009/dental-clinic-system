@extends('layouts.app')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Reminders</h2>

        <a href="{{ route('reminders.create') }}" class="btn btn-primary">
            Create Reminder
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-info">

        <tr>

            <th>ID</th>
            <th>Patient</th>
            <th>Date</th>
            <th>Type</th>
            <th>Status</th>
            <th width="280">Actions</th>

        </tr>

        </thead>

        <tbody>

        @forelse($reminders as $reminder)

        <tr>

            <td>{{ $reminder->reminder_id }}</td>

            <td>{{ $reminder->appointment->patient->patient_name }}</td>

            <td>{{ $reminder->reminder_date }}</td>

            <td>{{ $reminder->reminder_type }}</td>

            <td>{{ $reminder->reminder_status }}</td>

            <td class="text-nowrap">

                <a href="{{ route('reminders.show',$reminder->reminder_id) }}"
                   class="btn btn-info btn-sm">
                    View
                </a>

                <a href="{{ route('reminders.edit',$reminder->reminder_id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('reminders.destroy',$reminder->reminder_id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete reminder?')">

                        Delete

                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6" class="text-center">
                No reminders found.
            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    {{ $reminders->links() }}

</div>

@endsection