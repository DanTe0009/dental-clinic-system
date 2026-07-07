<?php

namespace App\Http\Controllers;

use App\Models\Dentist;
use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $dentists = Dentist::when($search, function ($query) use ($search) {

            $query->where('dentist_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('license_number', 'like', "%{$search}%");

        })
        ->orderBy('dentist_id')
        ->paginate(10);

        return view('dentists.index', compact('dentists','search'));
    }

    public function create()
    {
        return view('dentists.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'dentist_name'=>'required|max:100',
            'phone'=>'required|max:20',
            'email'=>'required|email|unique:DENTIST,email',
            'license_number'=>'required|max:50|unique:DENTIST,license_number',
            'years_experience'=>'required|integer|min:0'

        ]);

        Dentist::create($request->all());

        return redirect()
            ->route('dentists.index')
            ->with('success','Dentist added successfully.');
    }

    public function show($id)
{
    $dentist = Dentist::with([
        'appointments.patient',
        'specializations',
        'schedules'
    ])->findOrFail($id);

    return view('dentists.show', compact('dentist'));
}

    public function edit($id)
    {
        $dentist = Dentist::findOrFail($id);

        return view('dentists.edit',compact('dentist'));
    }

    public function update(Request $request,$id)
    {
        $dentist = Dentist::findOrFail($id);

        $request->validate([

            'dentist_name'=>'required|max:100',
            'phone'=>'required|max:20',

            'email'=>'required|email|unique:DENTIST,email,'.$dentist->dentist_id.',dentist_id',

            'license_number'=>'required|max:50|unique:DENTIST,license_number,'.$dentist->dentist_id.',dentist_id',

            'years_experience'=>'required|integer|min:0'

        ]);

        $dentist->update($request->all());

        return redirect()
            ->route('dentists.index')
            ->with('success','Dentist updated successfully.');
    }

    public function destroy($id)
    {
        $dentist = Dentist::findOrFail($id);

        try{

            $dentist->delete();

            return redirect()
                ->route('dentists.index')
                ->with('success','Dentist deleted successfully.');

        }catch(\Exception $e){

            return redirect()
                ->route('dentists.index')
                ->with('error','Cannot delete dentist because related records exist.');

        }

    }
}