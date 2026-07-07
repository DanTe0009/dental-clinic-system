<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $patients = Patient::when($search, function ($query) use ($search) {
            $query->where('patient_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy('patient_id')
        ->paginate(10);

        return view('patients.index', compact('patients', 'search'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|max:100',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email|unique:PATIENT,email',
        ]);

        Patient::create($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient added successfully.');
    }

    public function show($id)
{
    $patient = Patient::with('appointments.dentist')->findOrFail($id);

    return view('patients.show', compact('patient'));
}

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'patient_name' => 'required|max:100',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required',
            'phone' => 'required|max:20',
            'email' => 'required|email|unique:PATIENT,email,' . $patient->patient_id . ',patient_id',
        ]);

        $patient->update($request->all());

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy($id)
{
    $patient = Patient::findOrFail($id);

    $patient->delete();

    return redirect()
        ->route('patients.index')
        ->with('success', 'Patient deleted successfully.');
}
}