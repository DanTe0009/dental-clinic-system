@extends('layouts.app')

@section('content')

<h2 class="mb-4">
    Dashboard
</h2>

<div class="row">

    <div class="col-md-4">

        <div class="card text-bg-primary shadow">

            <div class="card-body">

                <h5>Total Patients</h5>

                <h1>{{ $patientCount }}</h1>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-bg-success shadow">

            <div class="card-body">

                <h5>Total Dentists</h5>

                <h1>{{ $dentistCount }}</h1>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card text-bg-warning shadow">

            <div class="card-body">

                <h5>Total Appointments</h5>

                <h1>{{ $appointmentCount }}</h1>

            </div>

        </div>

    </div>

</div>

@endsection