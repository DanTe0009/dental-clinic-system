<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\DentalRecord;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('record.appointment.patient')
            ->orderBy('treatment_id')
            ->paginate(10);

        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $records = DentalRecord::with('appointment.patient')
            ->orderBy('record_id')
            ->get();

        return view('treatments.create', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'record_id'=>'required|exists:DENTAL_RECORD,record_id',
            'treatment_name'=>'required|max:100',
            'description'=>'nullable',
            'treatment_cost'=>'required|numeric|min:0'
        ]);

        Treatment::create($request->all());

        return redirect()
            ->route('treatments.index')
            ->with('success','Treatment added successfully.');
    }

    public function show($id)
    {
        $treatment = Treatment::with('record.appointment.patient')
            ->findOrFail($id);

        return view('treatments.show', compact('treatment'));
    }

    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);

        $records = DentalRecord::with('appointment.patient')->get();

        return view('treatments.edit', compact(
            'treatment',
            'records'
        ));
    }

    public function update(Request $request,$id)
    {
        $treatment = Treatment::findOrFail($id);

        $request->validate([
            'record_id'=>'required|exists:DENTAL_RECORD,record_id',
            'treatment_name'=>'required|max:100',
            'description'=>'nullable',
            'treatment_cost'=>'required|numeric|min:0'
        ]);

        $treatment->update($request->all());

        return redirect()
            ->route('treatments.index')
            ->with('success','Treatment updated.');
    }

    public function destroy($id)
    {
        Treatment::findOrFail($id)->delete();

        return redirect()
            ->route('treatments.index')
            ->with('success','Treatment deleted.');
    }
}