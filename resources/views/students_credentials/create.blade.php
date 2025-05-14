@extends('layouts.main')
@section('title', 'Add Student Credentials')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="form-title">Add Student Credentials</h3><br>
                </div>
            </div>
            <form action="{{ route('students_credentials.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="student_name" class="form-field" placeholder="Enter student name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Email *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="email" name="email" class="form-field" placeholder="Enter email">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Password *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="password" class="form-field" placeholder="Enter password">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Description</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <textarea name="description" rows="5" class="textarea-field" placeholder="Enter description (Optional)"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Recovery Email</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="email" name="recovery_email" class="form-field" placeholder="Enter recovery email (Optional)">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Recovery Phone</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="recovery_phone" class="form-field" placeholder="Enter phone (Optional)">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
                        <button type="submit" class="success-btn">Save</button>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
@endsection