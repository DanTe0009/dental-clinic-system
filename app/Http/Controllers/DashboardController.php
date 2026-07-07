<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $patientCount = Patient::count();
        $dentistCount = Dentist::count();
        $appointmentCount = Appointment::count();

        return view('dashboard.index', compact(
            'patientCount',
            'dentistCount',
            'appointmentCount'
        ));
    }
}