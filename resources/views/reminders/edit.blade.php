@extends('layouts.app')

@section('content')

<div class="container">

<h2 class="mb-4">Edit Reminder</h2>

<form action="{{ route('reminders.update',$reminder->reminder_id) }}" method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label class="form-label">Appointment</label>

<select name="appointment_id" class="form-select">

@foreach($appointments as $appointment)

<option
value="{{ $appointment->appointment_id }}"
{{ $appointment->appointment_id==$reminder->appointment_id ? 'selected' : '' }}>

#{{ $appointment->appointment_id }}

-

{{ $appointment->patient->first_name }}

{{ $appointment->patient->last_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label class="form-label">Reminder Date</label>

<input
type="date"
name="reminder_date"
class="form-control"
value="{{ $reminder->reminder_date }}">

</div>

<div class="mb-3">

<label class="form-label">Reminder Type</label>

<select
name="reminder_type"
class="form-select">

<option value="SMS"
{{ $reminder->reminder_type=='SMS' ? 'selected' : '' }}>
SMS
</option>

<option value="Email"
{{ $reminder->reminder_type=='Email' ? 'selected' : '' }}>
Email
</option>

<option value="Call"
{{ $reminder->reminder_type=='Call' ? 'selected' : '' }}>
Call
</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Reminder Status</label>

<select
name="reminder_status"
class="form-select">

<option value="Pending"
{{ $reminder->reminder_status=='Pending' ? 'selected' : '' }}>
Pending
</option>

<option value="Sent"
{{ $reminder->reminder_status=='Sent' ? 'selected' : '' }}>
Sent
</option>

<option value="Failed"
{{ $reminder->reminder_status=='Failed' ? 'selected' : '' }}>
Failed
</option>

</select>

</div>

<button class="btn btn-success">

Update Reminder

</button>

<a
href="{{ route('reminders.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

@endsection