<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPreference;
use App\Models\Status;
use App\Models\Intake;
use App\Models\Portal;
use App\Models\University;
use App\Models\Qualification;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index()
    {
        $universities = University::with('commissions', 'country')->where('country_id', '!=', 166)->orderBy('name', 'asc')->get();
        $students = Student::with('qualification')->latest()->paginate(100);
        return view('students.index', compact('students', 'universities'));
    }

    public function create()
    {
        $universities = University::with('commissions', 'country')->where('country_id', '!=', 166)->orderBy('name', 'asc')->get();
        $qualifications = Qualification::all();
        $intakes = Intake::all();
        $statuses = Status::all();
        $portals = Portal::all();
        return view('students.create', compact('qualifications', 'universities', 'intakes', 'statuses', 'portals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'graduated_from' => 'nullable|string|max:255',
            'qualification_id' => 'nullable|exists:qualifications,id',
            'test' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'preferences' => 'nullable|array',
            'preferences.*.university_id' => 'required|exists:universities,id',
            'preferences.*.course' => 'required|string|max:255',
            'preferences.*.intake_id' => 'nullable|exists:intakes,id',
            'preferences.*.status_id' => 'nullable|exists:statuses,id',
            'preferences.*.notes' => 'nullable|string',
            'preferences.*.portal_url' => 'nullable|url|max:255',
            'preferences.*.applied_on' => 'nullable|date',
        ]);

        $student = Student::create([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'graduated_from' => $validated['graduated_from'] ?? null,
            'qualification_id' => $validated['qualification_id'] ?? null,
            'test' => $validated['test'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        if (!empty($validated['preferences'])) {
            foreach ($validated['preferences'] as $pref) {
                $student->preferences()->create([
                    'university_id' => $pref['university_id'],
                    'course' => $pref['course'],
                    'intake_id' => $pref['intake_id'] ?? null,
                    'status_id' => $pref['status_id'] ?? null,
                    'portal_id' => $pref['portal_id'] ?? null,
                    'notes' => $pref['notes'] ?? null,
                    'portal_url' => $pref['portal_url'] ?? null,
                    'applied_on' => $pref['applied_on'] ?? null,
                ]);
            }
        }

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }


    public function show(Student $student)
    {
        $student->load('preferences.university', 'preferences.intake', 'preferences.status');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $qualifications = Qualification::all();
        $universities = University::all();
        $intakes = Intake::all();
        $statuses = Status::all();
        $portals = Portal::all();

        $student->load('preferences');

        return view('students.edit', compact(
            'student',
            'qualifications',
            'universities',
            'intakes',
            'statuses',
            'portals'
        ));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
            'graduated_from' => 'nullable|string|max:255',
            'qualification_id' => 'nullable|exists:qualifications,id',
            'test' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'preferences.*.university_id' => 'required|exists:universities,id',
            'preferences.*.course' => 'required|string|max:255',
            'preferences.*.intake_id' => 'nullable|exists:intakes,id',
            'preferences.*.status_id' => 'nullable|exists:statuses,id',
            'preferences.*.portal_id' => 'nullable|exists:portals,id',
            'preferences.*.notes' => 'nullable|string',
            'preferences.*.portal_url' => 'nullable|url',
            'preferences.*.applied_on' => 'nullable|date',
        ]);

        $student = Student::findOrFail($id);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'graduated_from' => $validated['graduated_from'],
            'qualification_id' => $validated['qualification_id'],
            'test' => $validated['test'],
            'notes' => $validated['notes'],
        ]);

        if ($request->has('deleted_preferences')) {
            $deletedPreferences = $request->input('deleted_preferences');
            StudentPreference::whereIn('id', $deletedPreferences)->delete();
        }
        if (!empty($validated['preferences'])) {
            foreach ($validated['preferences'] as $preferenceData) {
                if (isset($preferenceData['id']) && $preferenceData['id']) {
                    $preference = StudentPreference::find($preferenceData['id']);
                    if ($preference) {
                        $preference->update([
                            'university_id' => $preferenceData['university_id'],
                            'course' => $preferenceData['course'],
                            'intake_id' => $preferenceData['intake_id'],
                            'status_id' => $preferenceData['status_id'],
                            'portal_id' => $preferenceData['portal_id'],
                            'notes' => $preferenceData['notes'],
                            'portal_url' => $preferenceData['portal_url'],
                            'applied_on' => $preferenceData['applied_on'],
                        ]);
                    }
                } else {
                    $student->preferences()->create([
                        'university_id' => $preferenceData['university_id'],
                        'course' => $preferenceData['course'],
                        'intake_id' => $preferenceData['intake_id'],
                        'status_id' => $preferenceData['status_id'],
                        'portal_id' => $preferenceData['portal_id'],
                        'notes' => $preferenceData['notes'],
                        'portal_url' => $preferenceData['portal_url'],
                        'applied_on' => $preferenceData['applied_on'],
                    ]);
                }
            }
        }

        return redirect()->route('students.show', $student->id)
            ->with('success', 'Student updated successfully');
    }



    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
