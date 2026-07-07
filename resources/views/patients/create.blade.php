@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">Add New Patient</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('patients.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Patient Name</label>

                        <input
                            type="text"
                            name="patient_name"
                            class="form-control @error('patient_name') is-invalid @enderror"
                            value="{{ old('patient_name') }}">

                        @error('patient_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-2 mb-3">

                        <label class="form-label">Age</label>

                        <input
                            type="number"
                            name="age"
                            class="form-control @error('age') is-invalid @enderror"
                            value="{{ old('age') }}">

                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Gender</label>

                        <select
                            name="gender"
                            class="form-select @error('gender') is-invalid @enderror">

                            <option value="">Select Gender</option>

                            <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>

                            <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>

                        </select>

                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Phone</label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}">

                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">Street</label>

                    <input
                        type="text"
                        name="street"
                        class="form-control"
                        value="{{ old('street') }}">

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">City</label>

                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            value="{{ old('city') }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">State</label>

                        <input
                            type="text"
                            name="state"
                            class="form-control"
                            value="{{ old('state') }}">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">Registration Date</label>

                        <input
                            type="date"
                            name="registration_date"
                            class="form-control"
                            value="{{ old('registration_date', date('Y-m-d')) }}">

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">Emergency Contact</label>

                    <input
                        type="text"
                        name="emergency_contact"
                        class="form-control"
                        value="{{ old('emergency_contact') }}">

                </div>

                <button class="btn btn-success">

                    Save Patient

                </button>

                <a href="{{ route('patients.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection