<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with('appointment.patient')
            ->orderBy('reminder_id')
            ->paginate(10);

        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        $appointments = Appointment::with('patient')
            ->orderBy('appointment_id')
            ->get();

        return view('reminders.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:APPOINTMENT,appointment_id',
            'reminder_date' => 'required|date',
            'reminder_type' => 'required|in:SMS,Email,Call',
            'reminder_status' => 'required|in:Pending,Sent,Failed',
        ]);

        Reminder::create($request->all());

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder created successfully.');
    }

    public function show($id)
    {
        $reminder = Reminder::with('appointment.patient')
            ->findOrFail($id);

        return view('reminders.show', compact('reminder'));
    }

    public function edit($id)
    {
        $reminder = Reminder::findOrFail($id);

        $appointments = Appointment::with('patient')
            ->orderBy('appointment_id')
            ->get();

        return view('reminders.edit', compact('reminder', 'appointments'));
    }

    public function update(Request $request, $id)
    {
        $reminder = Reminder::findOrFail($id);

        $request->validate([
            'appointment_id' => 'required|exists:APPOINTMENT,appointment_id',
            'reminder_date' => 'required|date',
            'reminder_type' => 'required|in:SMS,Email,Call',
            'reminder_status' => 'required|in:Pending,Sent,Failed',
        ]);

        $reminder->update($request->all());

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder updated successfully.');
    }

    public function destroy($id)
    {
        Reminder::findOrFail($id)->delete();

        return redirect()
            ->route('reminders.index')
            ->with('success', 'Reminder deleted successfully.');
    }
}