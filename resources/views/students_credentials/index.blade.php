@extends('layouts.main')

@section('title', 'Students Credentials')

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="form-wrapper">
            <div class="row">
				<div class="col-md-6 col-sm-8 col-xs-6">
					<h3 class="box-title">Students Emails</h3>	
				</div>
				<div class="col-md-6 col-sm-4 col-xs-6">
                    <div class="main-action-box">
                    <a href="{{ route('students_credentials.create') }}" class="primary-btn">Add New</a>
                    </div>
                </div>
			</div>
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Credentials</th>
                    <th>Description</th>
                    <th>Created On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentsCredentials as $credential)
                    <tr>
                        <td>{{ $credential->id }}</td>
                        <td>{{ $credential->student_name }}</td>
                        <td>Email: {{ $credential->email }} <br> Password: {{ $credential->password }}</td>
                        <td>{{ $credential->description ?? 'N/A' }} <br> Email: {{ $credential->recovery_email ?? 'N/A' }} <br> Phone: {{ $credential->recovery_phone ?? 'N/A' }} </td>
                        <td>{{ $credential->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('students_credentials.edit', $credential->id) }}" class="sm-primary-btn">Edit</a>
                            <form action="{{ route('students_credentials.destroy', $credential->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sm-danger-btn" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
