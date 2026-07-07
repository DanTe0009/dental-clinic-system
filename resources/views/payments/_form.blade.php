<div class="mb-3">

    <label class="form-label">

        Invoice

    </label>

    <select
        name="invoice_id"
        class="form-select"
        required>

        <option value="">
            Select Invoice
        </option>

        @foreach($invoices as $invoice)

            <option
                value="{{ $invoice->invoice_id }}"
                @selected(old('invoice_id', $payment->invoice_id ?? '') == $invoice->invoice_id)>

                Invoice #{{ $invoice->invoice_id }}

                -

                {{ $invoice->record->appointment->patient->patient_name }}

            </option>

        @endforeach

    </select>

</div>


<div class="mb-3">

    <label class="form-label">

        Amount Paid

    </label>

    <input
        type="number"
        step="0.01"
        name="amount_paid"
        class="form-control"
        value="{{ old('amount_paid', $payment->amount_paid ?? '') }}"
        required>

</div>


<div class="mb-3">

    <label class="form-label">

        Payment Date

    </label>

    <input
        type="date"
        name="payment_date"
        class="form-control"
        value="{{ old('payment_date', $payment->payment_date ?? '') }}"
        required>

</div>


<div class="mb-3">

    <label class="form-label">

        Payment Method

    </label>

    <input
        type="text"
        name="payment_method"
        class="form-control"
        value="{{ old('payment_method', $payment->payment_method ?? '') }}"
        required>

</div>


<button class="btn btn-success">

    Save

</button>

<a href="{{ route('payments.index') }}"
   class="btn btn-secondary">

    Cancel

</a>