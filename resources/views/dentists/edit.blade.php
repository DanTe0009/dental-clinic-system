@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h3>Edit Dentist</h3>

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

        <form action="{{ route('dentists.update',$dentist->dentist_id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Dentist Name</label>

                    <input
                        type="text"
                        name="dentist_name"
                        class="form-control"
                        value="{{ old('dentist_name',$dentist->dentist_name) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone',$dentist->phone) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$dentist->email) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">License Number</label>

                    <input
                        type="text"
                        name="license_number"
                        class="form-control"
                        value="{{ old('license_number',$dentist->license_number) }}"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Years of Experience</label>

                    <input
                        type="number"
                        name="years_experience"
                        class="form-control"
                        value="{{ old('years_experience',$dentist->years_experience) }}"
                        required>

                </div>

            </div>

            <button class="btn btn-success">
                Update Dentist
            </button>

            <a href="{{ route('dentists.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection