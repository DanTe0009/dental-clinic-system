@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h3>Add Dentist</h3>

    </div>

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('dentists.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Dentist Name</label>

                    <input
                        type="text"
                        name="dentist_name"
                        class="form-control"
                        value="{{ old('dentist_name') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">License Number</label>

                    <input
                        type="text"
                        name="license_number"
                        class="form-control"
                        value="{{ old('license_number') }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Years of Experience</label>

                    <input
                        type="number"
                        name="years_experience"
                        class="form-control"
                        value="{{ old('years_experience') }}"
                        required>

                </div>

            </div>

            <button class="btn btn-success">
                Save Dentist
            </button>

            <a href="{{ route('dentists.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection