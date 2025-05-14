@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Student</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        {{-- Student Information --}}
        <h4>Student Information</h4>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone ?? '') }}">
        </div>

        <!-- <div class="mb-3">
            <label>Current Education</label>
            <input type="text" name="current_education" class="form-control" value="{{ old('current_education', $student->current_education ?? '') }}">
        </div> -->

        <div class="mb-3">
            <label>Graduated From</label>
            <input type="text" name="graduated_from" class="form-control" value="{{ old('graduated_from', $student->graduated_from ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Qualification</label>
            <select name="qualification_id" class="form-control">
                <option value="">Select Qualification</option>
                @foreach ($qualifications as $qualification)
                <option value="{{ $qualification->id }}"
                    {{ old('qualification_id', $student->qualification_id ?? '') == $qualification->id ? 'selected' : '' }}>
                    {{ $qualification->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Test</label>
            <input type="text" name="test" class="form-control" value="{{ old('test', $student->test ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $student->notes ?? '') }}</textarea>
        </div>

        <hr>

        {{-- Preferences Section --}}
        <h4>Student Preferences</h4>
        <div id="preferences-container"></div>

        <button type="button" id="add-preference-btn" class="btn btn-outline-secondary mb-3">
            + Add Preference
        </button>

        <hr>
        <button type="submit" class="btn btn-primary">Save Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    let preferenceIndex = 0;

    document.addEventListener('DOMContentLoaded', function() {
        // Ensure the DOM is fully loaded before adding event listeners
        const addPreferenceButton = document.getElementById('add-preference-btn');

        if (addPreferenceButton) {
            addPreferenceButton.addEventListener('click', () => {
                console.log("Add Preference Button Clicked");

                const container = document.getElementById('preferences-container');
                if (container) {
                    const div = document.createElement('div');
                    div.classList.add('card', 'p-3', 'mb-3');
                    div.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Preference #${preferenceIndex + 1}</h6>
                            <button type="button" class="btn btn-sm btn-danger remove-preference">Remove</button>
                        </div>

                        <div class="mb-2">
                            <label>University</label>
                            <select name="preferences[${preferenceIndex}][university_id]" class="form-control" required>
                                <option value="">-- Select University --</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Course</label>
                            <input type="text" name="preferences[${preferenceIndex}][course]" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Intake</label>
                            <select name="preferences[${preferenceIndex}][intake_id]" class="form-control">
                                <option value="">-- Select Intake --</option>
                                @foreach($intakes as $intake)
                                    <option value="{{ $intake->id }}">{{ $intake->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Status</label>
                            <select name="preferences[${preferenceIndex}][status_id]" class="form-control">
                                <option value="">-- Select Status --</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Counsellor Notes</label>
                            <textarea name="preferences[${preferenceIndex}][counsellor_notes]" class="form-control">{{ old('counsellor_notes', $student->counsellor_notes ?? '') }}</textarea>
                        </div>

                        <div class="mb-2">
                            <label>Portal URL</label>
                            <input type="url" name="preferences[${preferenceIndex}][portal_url]" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label>Applied On</label>
                            <input type="date" name="preferences[${preferenceIndex}][applied_on]" class="form-control">
                        </div>
                    `;

                    container.appendChild(div);
                    preferenceIndex++;
                } else {
                    console.error("Preferences container not found!");
                }
            });
        } else {
            console.error("Add Preference Button not found!");
        }

        // Remove preference logic
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-preference')) {
                e.target.closest('.card').remove();
            }
        });
    });
</script>


@endsection