<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booked;
use App\Models\Cancelled;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\Rescheduled;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $appointments = Appointment::with(['patient', 'dentist'])

            ->when($search, function ($query) use ($search) {

                $query->whereHas('patient', function ($q) use ($search) {

                    $q->where('patient_name', 'like', "%{$search}%");

                })

                ->orWhereHas('dentist', function ($q) use ($search) {

                    $q->where('dentist_name', 'like', "%{$search}%");

                })

                ->orWhere('status', 'like', "%{$search}%");

            })

            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(10);

        return view('appointments.index', compact('appointments', 'search'));
    }

    public function create()
    {
        $patients = Patient::orderBy('patient_name')->get();

        $dentists = Dentist::orderBy('dentist_name')->get();

        return view('appointments.create', compact('patients', 'dentists'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'patient_id' => 'required|exists:PATIENT,patient_id',

            'dentist_id' => 'required|exists:DENTIST,dentist_id',

            'appointment_date' => 'required|date',

            'appointment_time' => 'required',

            'status' => 'required|in:Booked,Cancelled,Rescheduled'

        ]);

        $appointment = Appointment::create($request->all());

        $this->saveStatusRecord($appointment);

        return redirect()

            ->route('appointments.index')

            ->with('success', 'Appointment created successfully.');
    }

    public function show($id)
    {
        $appointment = Appointment::with([
            'patient',
            'dentist',
            'booked',
            'cancelled',
            'rescheduled'
        ])->findOrFail($id);

        return view('appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        $patients = Patient::orderBy('patient_name')->get();

        $dentists = Dentist::orderBy('dentist_name')->get();

        return view('appointments.edit', compact(
            'appointment',
            'patients',
            'dentists'
        ));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([

            'patient_id' => 'required|exists:PATIENT,patient_id',

            'dentist_id' => 'required|exists:DENTIST,dentist_id',

            'appointment_date' => 'required|date',

            'appointment_time' => 'required',

            'status' => 'required|in:Booked,Cancelled,Rescheduled'

        ]);

        $appointment->update($request->all());

        $this->removeStatusRecords($appointment->appointment_id);

        $this->saveStatusRecord($appointment);

        return redirect()

            ->route('appointments.index')

            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $this->removeStatusRecords($appointment->appointment_id);

        try {

            $appointment->delete();

            return redirect()

                ->route('appointments.index')

                ->with('success', 'Appointment deleted successfully.');

        } catch (\Exception $e) {

            return redirect()

                ->route('appointments.index')

                ->with('error', 'Cannot delete appointment because related records exist.');

        }
    }

    private function removeStatusRecords($appointmentId)
    {
        Booked::where('appointment_id', $appointmentId)->delete();

        Cancelled::where('appointment_id', $appointmentId)->delete();

        Rescheduled::where('appointment_id', $appointmentId)->delete();
    }

    private function saveStatusRecord($appointment)
    {
        if ($appointment->status == 'Booked') {

            Booked::create([

                'appointment_id' => $appointment->appointment_id,

                'confirmation_no' => 'CONF-' . now()->format('YmdHis'),

                'booked_on' => now()->toDateString()

            ]);

        }

        elseif ($appointment->status == 'Cancelled') {

            Cancelled::create([

                'appointment_id' => $appointment->appointment_id,

                'cancellation_reason' => 'Updated by system',

                'cancelled_on' => now()->toDateString(),

                'cancelled_by' => 'Receptionist'

            ]);

        }

        elseif ($appointment->status == 'Rescheduled') {

            Rescheduled::create([

                'appointment_id' => $appointment->appointment_id,

                'original_date' => $appointment->appointment_date,

                'original_time' => $appointment->appointment_time,

                'reschedule_reason' => 'Updated by system',

                'rescheduled_on' => now()->toDateString()

            ]);

        }
    }
}