<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
{
    $payments = Payment::with('invoice.record.appointment.patient')
        ->orderByDesc('payment_id')
        ->paginate(10);

    return view('payments.index', compact('payments'));
}

    public function create()
    {
        $invoices = Invoice::with('record.appointment.patient')
            ->orderBy('invoice_id')
            ->get();

        return view('payments.create', compact('invoices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:INVOICE,invoice_id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|max:50',
        ]);

        Payment::create($request->all());

        return redirect()
            ->route('payments.index')
            ->with('success','Payment recorded successfully.');
    }

    public function show($id)
{
    $payment = Payment::with('invoice.record.appointment.patient')
        ->findOrFail($id);

    return view('payments.show', compact('payment'));
}

    public function edit($id)
{
    $payment = Payment::findOrFail($id);

    $invoices = Invoice::with('record.appointment.patient')
        ->orderBy('invoice_id')
        ->get();

    return view('payments.edit', compact('payment','invoices'));
}

    public function update(Request $request,$id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'invoice_id'=>'required|exists:INVOICE,invoice_id',
            'amount_paid'=>'required|numeric|min:0',
            'payment_date'=>'required|date',
            'payment_method'=>'required|max:50',
        ]);

        $payment->update($request->all());

        return redirect()
            ->route('payments.index')
            ->with('success','Payment updated successfully.');
    }

    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();

        return redirect()
            ->route('payments.index')
            ->with('success','Payment deleted successfully.');
    }
}