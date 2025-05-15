@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Student Details</h1>

    {{-- Student Information --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Student Information</h4>
        </div>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Phone:</strong> {{ $student->phone }}</p>
            <p><strong>Qualification:</strong> {{ $student->qualification ? $student->qualification->name : 'N/A' }}</p>
            <p><strong>Graduated From:</strong> {{ $student->graduated_from }}</p>
            <p><strong>Test:</strong> {{ $student->test }}</p>
            <p><strong>Notes:</strong> {{ $student->notes }}</p>
        </div>
    </div>

    {{-- Preferences Section --}}
    <div class="card">
        <div class="card-header">
            <h4>Student Preferences</h4>
        </div>
        <div class="card-body">
            @if ($student->preferences->isEmpty())
            <p>No preferences available for this student.</p>
            @else
            <div class="list-group">
                @foreach ($student->preferences as $preference)
                <div class="list-group-item">
                    <h5>Preference #{{ $loop->iteration }}</h5>
                    <p><strong>University:</strong> {{ $preference->university->name }}</p>
                    <p><strong>Course:</strong> {{ $preference->course }}</p>
                    <p><strong>Intake:</strong> {{ $preference->intake ? $preference->intake->name : 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $preference->status ? $preference->status->name : 'N/A' }}</p>
                    <p><strong>Counsellor Notes:</strong> {{ $preference->counsellor_notes }}</p>
                    <p><strong>Portal URL:</strong> <a href="{{ $preference->portal_url }}" target="_blank">{{ $preference->portal_url }}</a></p>
                    <p><strong>Applied On:</strong> {{ $preference->applied_on ? \Carbon\Carbon::parse($preference->applied_on)->format('d M Y') : 'N/A' }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <hr>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to Student List</a>
</div>
@endsection