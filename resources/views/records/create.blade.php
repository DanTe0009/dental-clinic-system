@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Add Dental Record</h3>

    </div>

    <div class="card-body">

        <form action="{{ route('records.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Appointment</label>

                <select name="appointment_id" class="form-select">

                    @foreach($appointments as $appointment)

                        <option value="{{ $appointment->appointment_id }}">

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
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Allergies</label>

                <input
                    type="text"
                    name="allergies"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Medical History</label>

                <textarea
                    name="medical_history"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <button class="btn btn-success">

                Save

            </button>

            <a href="{{ route('records.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection