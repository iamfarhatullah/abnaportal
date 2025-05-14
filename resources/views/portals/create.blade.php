<!-- resources/views/portals/create.blade.php -->
@extends('layouts.main')
@section('title', 'Add New Portal')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add New Portal</h3><br>
            <form action="{{ route('portals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Portal Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="name" class="form-field" value="{{ old('name') }}" placeholder="Enter Portal Name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Portal Logo *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="file" id="picture" name="image" class="form-field">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 col-sm-3"></div>
                    <div class="col-md-6 col-sm-7">
                        <div class="pull-right">
                            <input type="reset" class="primary-btn" value="Reset">
                            <button type="submit" class="success-btn">Save</button><br><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection