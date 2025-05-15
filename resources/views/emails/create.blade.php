@extends('layouts.main')
@section('title', 'Add Student Credentials')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="form-title">Add New Email</h3><br>
                </div>
            </div>
            <form action="{{ route('emails.store') }}" method="POST">
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