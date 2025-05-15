@extends('layouts.main')
@section('title', 'Emails')
@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-wrapper">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-6">
                    <h3 class="box-title">Emails</h3>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-6">
                    <div class="main-action-box">
                        <a href="{{ route('emails.create') }}" class="primary-btn">Add New</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="searchInput" onkeyup="searchTable()" class="form-field" placeholder="Search...">
                </div>
            </div>
            <table id="search-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Description</th>
                        <th style="width: 94px;">Created On</th>
                        <th style="width: 92px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emails as $credential)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $credential->student_name }}</td>
                        <td>{{ $credential->email }}</td>
                        <td>{{ $credential->password }}</td>
                        <td>
                            {{ $credential->description ?? '--' }}
                        </td>
                        <td>{{ $credential->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('emails.edit', $credential->id) }}" class="sm-primary-btn">Edit</a>
                            <form action="{{ route('emails.destroy', $credential->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sm-delete-btn" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
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