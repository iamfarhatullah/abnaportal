<?php

namespace App\Http\Controllers;

use App\Models\Portal;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index()
    {
        $portals = Portal::all();
        return view('portals.index', compact('portals'));
    }

    public function create()
    {
        return view('portals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        Portal::create([
            'name' => $validated['name'],
            'image' => $imageName,
        ]);
        session()->flash('success', 'Portal created successfully!');
        return redirect()->route('portals.index');
    }

    public function show($id)
    {
        $portal = Portal::findOrFail($id);
        return view('portals.show', compact('portal'));
    }

    public function edit($id)
    {
        $portal = Portal::findOrFail($id);
        return view('portals.edit', compact('portal'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $portal = Portal::findOrFail($id);
        $portal->name = $validated['name'];
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $portal->image = $imageName;
        }
        $portal->save();
        session()->flash('success', 'Portal updated successfully!');
        return redirect()->route('portals.index');
    }

    public function destroy($id)
    {
        $portal = Portal::findOrFail($id);
        $portal->delete();
        session()->flash('success', 'Portal deleted successfully!');
        return redirect()->route('portals.index');
    }
}
