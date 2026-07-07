@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Add Schedule</h3>

    </div>

    <div class="card-body">

        <form action="{{ route('schedules.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Dentist</label>

                <select name="dentist_id" class="form-select">

                    @foreach($dentists as $dentist)

                        <option value="{{ $dentist->dentist_id }}">

                            {{ $dentist->dentist_name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Date</label>

                <input type="date"
                       name="available_date"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Start Time</label>

                <input type="time"
                       name="start_time"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>End Time</label>

                <input type="time"
                       name="end_time"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Availability</label>

                <select name="is_available"
                        class="form-select">

                    <option value="1">

                        Available

                    </option>

                    <option value="0">

                        Unavailable

                    </option>

                </select>

            </div>

            <button class="btn btn-success">

                Save

            </button>

            <a href="{{ route('schedules.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection