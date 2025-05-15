@extends('layouts.main')

@section('content')

<div class="container">
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Student Information --}}
        <h4>Student Information</h4>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
        </div>

        <div class="mb-3">
            <label>Graduated From</label>
            <input type="text" name="graduated_from" class="form-control" value="{{ old('graduated_from', $student->graduated_from) }}">
        </div>

        <div class="mb-3">
            <label>Qualification</label>
            <select name="qualification_id" class="form-control">
                <option value="">Select Qualification</option>
                @foreach ($qualifications as $qualification)
                <option value="{{ $qualification->id }}"
                    {{ old('qualification_id', $student->qualification_id) == $qualification->id ? 'selected' : '' }}>
                    {{ $qualification->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Test</label>
            <input type="text" name="test" class="form-control" value="{{ old('test', $student->test) }}">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $student->notes) }}</textarea>
        </div>

        <hr>

        {{-- Preferences Section --}}
        <h4>Student Preferences</h4>
        <div id="preferences-container">
            @foreach ($student->preferences as $index => $pref)
            <div class="card p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6>Preference #{{ $index + 1 }}</h6>
                    <button type="button" class="btn btn-sm btn-danger remove-preference">Remove</button>
                </div>
                <input type="hidden" name="preferences[{{ $index }}][id]" value="{{ $pref->id }}">

                <div class="mb-2">
                    <label>University</label>
                    <select name="preferences[{{ $index }}][university_id]" class="form-control" required>
                        <option value="">-- Select University --</option>
                        @foreach($universities as $university)
                        <option value="{{ $university->id }}" {{ $pref->university_id == $university->id ? 'selected' : '' }}>
                            {{ $university->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="deleted_preferences[]" value="{{ $pref->id }}">


                <div class="mb-2">
                    <label>Course</label>
                    <input type="text" name="preferences[{{ $index }}][course]" class="form-control" value="{{ $pref->course }}" required>
                </div>

                <div class="mb-2">
                    <label>Intake</label>
                    <select name="preferences[{{ $index }}][intake_id]" class="form-control">
                        <option value="">-- Select Intake --</option>
                        @foreach($intakes as $intake)
                        <option value="{{ $intake->id }}" {{ $pref->intake_id == $intake->id ? 'selected' : '' }}>
                            {{ $intake->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Portal</label>
                    <select name="preferences[${preferenceIndex}][portal_id]" class="form-control">
                        <option value="">-- Select Portal --</option>
                        @foreach($portals as $portal)
                        <option value="{{ $portal->id }}">{{ $portal->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Status</label>
                    <select name="preferences[{{ $index }}][status_id]" class="form-control">
                        <option value="">-- Select Status --</option>
                        @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ $pref->status_id == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Counsellor Notes</label>
                    <textarea name="preferences[{{ $index }}][notes]" class="form-control">{{ $pref->notes }}</textarea>
                </div>

                <div class="mb-2">
                    <label>Portal URL</label>
                    <input type="url" name="preferences[{{ $index }}][portal_url]" class="form-control" value="{{ $pref->portal_url }}">
                </div>

                <div class="mb-2">
                    <label>Applied On</label>
                    <input type="date" name="preferences[{{ $index }}][applied_on]" class="form-control" value="{{ $pref->applied_on }}">
                </div>
            </div>
            @endforeach
        </div>
        <button type="button" id="add-preference-btn" class="btn btn-outline-secondary mb-3">
            + Add Preference
        </button>
        <hr>
        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('preferences-container');
        let preferenceIndex = container.querySelectorAll('.card').length;

        document.getElementById('add-preference-btn').addEventListener('click', () => {
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
                            <label>Portal</label>
                            <select name="preferences[${preferenceIndex}][portal_id]" class="form-control">
                                <option value="">-- Select Portal --</option>
                                @foreach($portals as $portal)
                                    <option value="{{ $portal->id }}">{{ $portal->name }}</option>
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
                <div class="mb-2">
                    <label>Counsellor Notes</label>
                    <textarea name="preferences[${preferenceIndex}][notes]" class="form-control"></textarea>
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
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-preference')) {
                const card = e.target.closest('.card');
                const hiddenIdInput = card.querySelector('input[name^="preferences"][name$="[id]"]');
                if (hiddenIdInput) {
                    const prefId = hiddenIdInput.value;
                    const deletedInput = document.createElement('input');
                    deletedInput.type = 'hidden';
                    deletedInput.name = 'deleted_preferences[]';
                    deletedInput.value = prefId;
                    container.appendChild(deletedInput);
                }
                card.remove();
            }
        });
    });
</script>


@endsection