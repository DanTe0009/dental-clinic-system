@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-header bg-warning">

        <h4 class="mb-0">
            Edit Patient
        </h4>

    </div>

    <div class="card-body">

        <form action="{{ route('patients.update',$patient->patient_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Patient Name</label>

                    <input
                        type="text"
                        name="patient_name"
                        class="form-control"
                        value="{{ old('patient_name',$patient->patient_name) }}">

                </div>

                <div class="col-md-2 mb-3">

                    <label class="form-label">Age</label>

                    <input
                        type="number"
                        name="age"
                        class="form-control"
                        value="{{ old('age',$patient->age) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">Gender</label>

                    <select
                        name="gender"
                        class="form-select">

                        <option value="Male"
                            {{ old('gender',$patient->gender)=='Male'?'selected':'' }}>
                            Male
                        </option>

                        <option value="Female"
                            {{ old('gender',$patient->gender)=='Female'?'selected':'' }}>
                            Female
                        </option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone',$patient->phone) }}">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$patient->email) }}">

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">Street</label>

                <input
                    type="text"
                    name="street"
                    class="form-control"
                    value="{{ old('street',$patient->street) }}">

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">City</label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="{{ old('city',$patient->city) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">State</label>

                    <input
                        type="text"
                        name="state"
                        class="form-control"
                        value="{{ old('state',$patient->state) }}">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">Registration Date</label>

                    <input
                        type="date"
                        name="registration_date"
                        class="form-control"
                        value="{{ old('registration_date',$patient->registration_date) }}">

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label">Emergency Contact</label>

                <input
                    type="text"
                    name="emergency_contact"
                    class="form-control"
                    value="{{ old('emergency_contact',$patient->emergency_contact) }}">

            </div>

            <button class="btn btn-warning">
                Update Patient
            </button>

            <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection