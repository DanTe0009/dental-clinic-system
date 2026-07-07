<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DentistController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DentalRecordController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\XrayController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReminderController;

Route::get('/', [DashboardController::class, 'index']);

Route::resource('patients', PatientController::class);

Route::resource('dentists', DentistController::class);

Route::resource('appointments', AppointmentController::class);

Route::resource('schedules', ScheduleController::class);

Route::resource('records', DentalRecordController::class);

Route::resource('treatments', TreatmentController::class);

Route::resource('prescriptions', PrescriptionController::class);

Route::resource('xrays', XrayController::class);

Route::resource('invoices', InvoiceController::class);

Route::resource('payments', PaymentController::class);

Route::resource('reminders', ReminderController::class);