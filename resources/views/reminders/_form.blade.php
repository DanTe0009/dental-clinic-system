<div class="mb-3">
    <label class="form-label">Appointment</label>

    <select name="appointment_id" class="form-control" required>

        <option value="">Select Appointment</option>

        @foreach($appointments as $appointment)

            <option value="{{ $appointment->appointment_id }}"
                {{ old('appointment_id', $reminder->appointment_id ?? '') == $appointment->appointment_id ? 'selected' : '' }}>

                #{{ $appointment->appointment_id }}
                -
                {{ $appointment->patient->patient_name }}

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
        value="{{ old('reminder_date', $reminder->reminder_date ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Reminder Type</label>

    <input
        type="text"
        name="reminder_type"
        class="form-control"
        value="{{ old('reminder_type', $reminder->reminder_type ?? '') }}"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Reminder Status</label>

    <input
        type="text"
        name="reminder_status"
        class="form-control"
        value="{{ old('reminder_status', $reminder->reminder_status ?? '') }}"
        required>
</div>