<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index()
    {
        $countries = University::select('country_id')
            ->distinct()
            ->with('country')
            ->get()
            ->pluck('country')
            ->sortBy('name');
        $regions = Region::all();
        $universities = University::with('country')->orderBy('country_id', 'asc')->orderBy('name', 'asc')->get();
        return view('universities.index', compact('regions', 'universities', 'countries'));
    }

    public function create()
    {
        $regions = Region::all();
        $countries = Country::all();
        return view('universities.create', compact('regions', 'countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'country_id' => 'required|exists:countries,id',
            'region_id' => 'required|exists:regions,id',
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

    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }

    public function edit(University $university)
    {
        $regions = Region::all();
        $countries = Country::all();
        return view('universities.edit', compact('regions', 'university', 'countries'));
    }

    public function update(Request $request, University $university)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|max:2048',
            'country_id' => 'required|exists:countries,id',
            'region_id' => 'required|exists:regions,id',
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

    public function destroy(University $university)
    {
        $university->delete();
        return redirect()->route('universities.index')->with('success', 'University deleted successfully.');
    }
}
