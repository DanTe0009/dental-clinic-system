<?php

namespace App\Http\Controllers;

use App\Models\DentalRecord;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DentalRecordController extends Controller
{
    public function index()
    {
        $records = DentalRecord::with([
            'appointment.patient',
            'appointment.dentist'
        ])
        ->orderBy('record_id')
        ->paginate(10);

        return view('records.index', compact('records'));
    }

   public function create()
{
    $appointments = Appointment::with([
            'patient',
            'dentist'
        ])
        ->whereDoesntHave('dentalRecord')
        ->orderBy('appointment_date')
        ->get();

    return view('records.create', compact('appointments'));
}

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:APPOINTMENT,appointment_id',
            'created_date' => 'required|date',
            'allergies' => 'nullable|max:255',
            'medical_history' => 'nullable'
        ]);

        DentalRecord::create($request->all());

        return redirect()
            ->route('records.index')
            ->with('success','Dental record created successfully.');
    }

    public function show($id)
    {
        $record = DentalRecord::with([
            'appointment.patient',
            'appointment.dentist',
            'treatments',
            'prescriptions',
            'xrays',
            'invoice'
        ])->findOrFail($id);

        return view('records.show', compact('record'));
    }

    public function edit($id)
{
    $record = DentalRecord::findOrFail($id);

    $appointments = Appointment::with([
            'patient',
            'dentist'
        ])
        ->whereDoesntHave('dentalRecord')
        ->orWhere('appointment_id', $record->appointment_id)
        ->get();

    return view('records.edit', compact(
        'record',
        'appointments'
    ));
}

    public function update(Request $request,$id)
    {
        $record = DentalRecord::findOrFail($id);

        $request->validate([
            'appointment_id'=>'required|exists:APPOINTMENT,appointment_id',
            'created_date'=>'required|date',
            'allergies'=>'nullable|max:255',
            'medical_history'=>'nullable'
        ]);

        $record->update($request->all());

        return redirect()
            ->route('records.index')
            ->with('success','Dental record updated.');
    }

    public function destroy($id)
    {
        $record = DentalRecord::findOrFail($id);

        $record->delete();

        return redirect()
            ->route('records.index')
            ->with('success','Dental record deleted.');
    }
}