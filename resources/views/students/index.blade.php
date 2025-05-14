@extends('layouts.main')

@section('content')
<div class="container">
    <h1>All Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add New Student</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Graduated From</th>
                <th>Qualification</th>
                <th>Preferences</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->graduated_from }}</td>
                <td>{{ optional($student->qualification)->name }}</td>
                <td>
                    @foreach ($student->preferences as $preference)
                    <span class="badge bg-info">{{ $preference->university->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection