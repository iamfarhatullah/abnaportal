<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{

    public function index()
    {
        $emails = Email::orderBy('id', 'desc')->get();
        return view('emails.index', compact('emails'));
    }

    public function create()
    {
        return view('emails.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'email' => 'required|email|unique:emails',
            'password' => 'required|min:6',
            'description' => 'nullable'
        ]);

        Email::create([
            'student_name' => $request->student_name,
            'email' => $request->email,
            'password' => $request->password,
            'description' => $request->description
        ]);

        return redirect()->route('emails.index')->with('success', 'Email added successfully.');
    }

    public function edit($id)
    {
        $email = Email::findOrFail($id);
        return view('emails.edit', compact('email'));
    }

    public function update(Request $request, $id)
    {
        $email = Email::findOrFail($id);

        $request->validate([
            'student_name' => 'required',
            'email' => 'required|email|unique:emails,email,' . $id,
            'description' => 'nullable'
        ]);

        $data = [
            'student_name' => $request->student_name,
            'email' => $request->email,
            'description' => $request->description
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $email->update($data);

        return redirect()->route('emails.index')->with('success', 'Email updated successfully.');
    }

    public function destroy($id)
    {
        $email = Email::findOrFail($id);
        $email->delete();

        return redirect()->route('emails.index')->with('success', 'Email deleted successfully.');
    }
}
