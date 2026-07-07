<?php

namespace App\Http\Controllers;

use App\Models\Xray;
use App\Models\DentalRecord;
use Illuminate\Http\Request;

class XrayController extends Controller
{
    public function index()
    {
        $xrays = Xray::with('record.appointment.patient')
            ->orderBy('xray_id')
            ->paginate(10);

        return view('xrays.index', compact('xrays'));
    }

    public function create()
    {
        $records = DentalRecord::with('appointment.patient')
            ->orderBy('record_id')
            ->get();

        return view('xrays.create', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id',
            'file_path' => 'required|max:255',
            'xray_date' => 'required|date',
            'xray_type' => 'required|max:100',
        ]);

        Xray::create($request->all());

        return redirect()
            ->route('xrays.index')
            ->with('success', 'X-Ray added successfully.');
    }

    public function show($id)
    {
        $xray = Xray::with('record.appointment.patient')
            ->findOrFail($id);

        return view('xrays.show', compact('xray'));
    }

    public function edit($id)
    {
        $xray = Xray::findOrFail($id);

        $records = DentalRecord::with('appointment.patient')->get();

        return view('xrays.edit', compact('xray', 'records'));
    }

    public function update(Request $request, $id)
    {
        $xray = Xray::findOrFail($id);

        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id',
            'file_path' => 'required|max:255',
            'xray_date' => 'required|date',
            'xray_type' => 'required|max:100',
        ]);

        $xray->update($request->all());

        return redirect()
            ->route('xrays.index')
            ->with('success', 'X-Ray updated.');
    }

    public function destroy($id)
    {
        Xray::findOrFail($id)->delete();

        return redirect()
            ->route('xrays.index')
            ->with('success', 'X-Ray deleted.');
    }
}