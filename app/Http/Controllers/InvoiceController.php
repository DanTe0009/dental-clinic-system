<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\DentalRecord;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('record.appointment.patient')
            ->orderBy('invoice_id')
            ->paginate(10);

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $records = DentalRecord::with('appointment.patient')
            ->whereDoesntHave('invoice')
            ->orderBy('record_id')
            ->get();

        return view('invoices.create', compact('records'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id|unique:INVOICE,record_id',
            'generated_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:Unpaid,Partial,Paid',
        ]);

        Invoice::create($request->all());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    public function show($id)
    {
        $invoice = Invoice::with('record.appointment.patient')
            ->findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);

        $records = DentalRecord::with('appointment.patient')
            ->orderBy('record_id')
            ->get();

        return view('invoices.edit', compact('invoice', 'records'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $request->validate([
            'record_id' => 'required|exists:DENTAL_RECORD,record_id|unique:INVOICE,record_id,'.$invoice->invoice_id.',invoice_id',
            'generated_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:Unpaid,Partial,Paid',
        ]);

        $invoice->update($request->all());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy($id)
    {
        Invoice::findOrFail($id)->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}