@extends('layouts.main')
@section('title', 'Edit Portal')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Edit Portal</h3><br>
            <form action="{{ route('portals.update', $portal->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Portal Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="name" class="form-field" value="{{ $portal->name }}" placeholder="Enter Portal Name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Portal Logo (Optional)</label>
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
                            <button type="submit" class="success-btn">Update</button><br><br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection