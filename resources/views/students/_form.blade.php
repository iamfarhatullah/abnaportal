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

<div class="mb-3">
    <label>Current Education</label>
    <input type="text" name="current_education" class="form-control" value="{{ old('current_education', $student->current_education ?? '') }}">
</div>

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