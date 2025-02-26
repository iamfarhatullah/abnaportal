<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Country;
use Illuminate\Http\Request;

class UniversityController extends Controller{
    public function index(){
        $universities = University::with('country')->orderBy('name', 'asc')->get();
        return view('universities.index', compact('universities'));
    }

    public function create(){
        $countries = Country::all();
        return view('universities.create', compact('countries'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'country_id' => 'required|exists:countries,id',
        ]);
        $data = $request->all();
        if ($request->hasFile('picture')) {
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads'), $imageName);
            $data['picture'] = 'uploads/' . $imageName;
        }
        University::create($data);
        return redirect()->route('universities.index')->with('success', 'University created successfully.');
    }

    public function show(University $university){
        return view('universities.show', compact('university'));
    }

    public function edit(University $university){
        $countries = Country::all();
        return view('universities.edit', compact('university', 'countries'));
    }

    public function update(Request $request, University $university){
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'country_id' => 'required|exists:countries,id',
        ]);
        $data = $request->all();
        if ($request->hasFile('picture')) {
            if ($university->picture && file_exists(public_path($university->picture))) {
                unlink(public_path($university->picture));
            }
            $imageName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads'), $imageName);
            $data['picture'] = 'uploads/' . $imageName;
        }
        $university->update($data);
        return redirect()->route('universities.index')->with('success', 'University updated successfully.');
    }

    public function destroy(University $university){
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'University deleted successfully.');
    }
}
