<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Dentist;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('dentist')
            ->orderBy('available_date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $dentists = Dentist::orderBy('dentist_name')->get();

        return view('schedules.create', compact('dentists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dentist_id' => 'required|exists:DENTIST,dentist_id',
            'available_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_available' => 'required'
        ]);

        Schedule::create($request->all());

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function show($id)
    {
        $schedule = Schedule::with('dentist')->findOrFail($id);

        return view('schedules.show', compact('schedule'));
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);

        $dentists = Dentist::orderBy('dentist_name')->get();

        return view('schedules.edit', compact('schedule', 'dentists'));
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $request->validate([
            'dentist_id' => 'required|exists:DENTIST,dentist_id',
            'available_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_available' => 'required'
        ]);

        $schedule->update($request->all());

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);

        $schedule->delete();

        return redirect()
            ->route('schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}