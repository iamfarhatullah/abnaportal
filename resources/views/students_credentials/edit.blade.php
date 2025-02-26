@extends('layouts.main')
@section('title', 'Edit Student Credentials')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="form-title">Edit</h3><br>
                    </div>
                </div>
                <form action="{{ route('students_credentials.update', $credential->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Student Name*</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <input type="text" name="student_name" class="form-field" value="{{ $credential->student_name }}" placeholder="Enter Student Name" required>
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Email*</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <input type="email" name="email" class="form-field" value="{{ $credential->email }}" placeholder="Enter Student Email" required>
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Password*</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <input type="text" name="password" value="{{ $credential->password }}" class="form-field" placeholder="Enter Password">
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Description</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <textarea name="description" rows="5" class="textarea-field">{{ $credential->description }}</textarea>
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Recovery Email</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <input type="email" name="recovery_email" class="form-field" placeholder="Enter Recovery Email" value="{{ $credential->recovery_email }}">
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-sm-3">
                            <label>Recovery Phone</label>
                        </div>
                        <div class="col-md-6 col-sm-7">
                            <input type="text" name="recovery_phone" class="form-field" placeholder="Enter Phone No" value="{{ $credential->recovery_phone }}">
                        </div>
                    </div>    
                    <hr>
                    <div class="row">
                        <div class="col-md-2 col-sm-3"></div>
                        <div class="col-md-6 col-sm-7">
                            <button type="submit" class="success-btn">Update</button>
                        </div>
                    </div>
                    <br>

                </form>
            </div>
        </div>
    </div>
@endsection
