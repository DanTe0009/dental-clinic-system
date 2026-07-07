<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic Appointment System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="row g-0">

    <!-- Sidebar -->
    <div class="col-md-2 bg-dark text-white min-vh-100 p-0">

        <div class="text-center py-4 border-bottom">
            <h4>🦷 DCAS</h4>
            <small>Dental Clinic System</small>
        </div>

        <ul class="nav flex-column mt-3">

            <li class="nav-item">
                <a href="/" class="nav-link text-white">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('patients.index') }}" class="nav-link text-white">
                    <i class="bi bi-people-fill me-2"></i>
                    Patients
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('dentists.index') }}" class="nav-link text-white">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Dentists
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('appointments.index') }}" class="nav-link text-white">
                    <i class="bi bi-calendar-check-fill me-2"></i>
                    Appointments
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('schedules.index') }}" class="nav-link text-white">
                    <i class="bi bi-clock-history"></i>
                    Schedule
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('records.index') }}" class="nav-link text-white">
                    <i class="bi bi-file-medical-fill"></i>
                    Dental Records
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('treatments.index') }}" class="nav-link text-white">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Treatments
                    </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('prescriptions.index') }}" class="nav-link text-white">
                    <i class="bi bi-capsule-pill"></i>
                    Prescriptions
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('xrays.index') }}" class="nav-link text-white">
                    <i class="bi bi-image"></i>
                    X-Rays
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('invoices.index') }}" class="nav-link text-white">
                    <i class="bi bi-receipt"></i>
                    Invoices
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('payments.index') }}" class="nav-link text-white">
                    <i class="bi bi-credit-card-fill me-2"></i>
                    Payments
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('reminders.index') }}" class="nav-link text-white">
                    <i class="bi bi-bell-fill"></i>
                    Reminders
                </a>
            </li>

        </ul>

    </div>

    <!-- Main Content -->
    <div class="col-md-10">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">

            <div class="container-fluid">

                <span class="navbar-brand fw-bold">
                    Dental Clinic Appointment System
                </span>

            </div>

        </nav>

        <div class="container">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>