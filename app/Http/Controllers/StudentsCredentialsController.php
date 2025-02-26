<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentsCredentials;

class StudentsCredentialsController extends Controller
{
    public function index()
    {
        $studentsCredentials = StudentsCredentials::all();
        return view('students_credentials.index', compact('studentsCredentials'));
    }

    public function create()
    {
        return view('students_credentials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'email' => 'required|email|unique:students_credentials',
            'password' => 'required|min:6',
            'description' => 'nullable',
            'recovery_email' => 'nullable|email',
            'recovery_phone' => 'nullable|digits_between:10,15'
        ]);

        StudentsCredentials::create([
            'student_name' => $request->student_name,
            'email' => $request->email,
            'password' => $request->password,
            'description' => $request->description,
            'recovery_email' => $request->recovery_email,
            'recovery_phone' => $request->recovery_phone
        ]);

        return redirect()->route('students_credentials.index')->with('success', 'Student credentials added successfully.');
    }

    public function edit($id)
    {
        $credential = StudentsCredentials::findOrFail($id);
        return view('students_credentials.edit', compact('credential'));
    }

    public function update(Request $request, $id)
    {
        $credential = StudentsCredentials::findOrFail($id);

        $request->validate([
            'student_name' => 'required',
            'email' => 'required|email|unique:students_credentials,email,' . $id,
            'description' => 'nullable',
            'recovery_email' => 'nullable|email',
            'recovery_phone' => 'nullable|digits_between:10,15'
        ]);

        $data = [
            'student_name' => $request->student_name,
            'email' => $request->email,
            'description' => $request->description,
            'recovery_email' => $request->recovery_email,
            'recovery_phone' => $request->recovery_phone
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->password;
        }

        $credential->update($data);

        return redirect()->route('students_credentials.index')->with('success', 'Student credentials updated successfully.');
    }

    public function destroy($id)
    {
        $credential = StudentsCredentials::findOrFail($id);
        $credential->delete();

        return redirect()->route('students_credentials.index')->with('success', 'Student credentials deleted successfully.');
    }
}

