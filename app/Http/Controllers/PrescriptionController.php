<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\DentalRecord;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with('record.appointment.patient')
            ->orderBy('prescription_id')
            ->paginate(10);

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $records = DentalRecord::with('appointment.patient')
            ->orderBy('record_id')
            ->get();

        return view('prescriptions.create', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id',
            'medicine_name' => 'required|max:100',
            'dosage' => 'required|max:100',
            'frequency' => 'required|max:100',
            'duration_days' => 'required|integer|min:1',
        ]);

        Prescription::create($request->all());

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Prescription added successfully.');
    }

    public function show($id)
    {
        $prescription = Prescription::with('record.appointment.patient')
            ->findOrFail($id);

        return view('prescriptions.show', compact('prescription'));
    }

    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);

        $records = DentalRecord::with('appointment.patient')->get();

        return view('prescriptions.edit', compact(
            'prescription',
            'records'
        ));
    }

    public function update(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);

        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id',
            'medicine_name' => 'required|max:100',
            'dosage' => 'required|max:100',
            'frequency' => 'required|max:100',
            'duration_days' => 'required|integer|min:1',
        ]);

        $prescription->update($request->all());

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Prescription updated.');
    }

    public function destroy($id)
    {
        Prescription::findOrFail($id)->delete();

        return redirect()
            ->route('prescriptions.index')
            ->with('success', 'Prescription deleted.');
    }
}