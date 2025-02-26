@extends('layouts.main')
@section('title', 'Add New University')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-wrapper">
            <h3 class="form-title">Add New University</h3><br>
            <form action="{{ route('universities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>University Name *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="text" name="name" class="form-field" value="{{ old('name') }}" placeholder="Enter University Name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Country *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <select id="country_id" name="country_id" class="form-field">
                            <option value="">Select a Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Region *</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <select class="form-field" id="region_id" name="region_id">
                            <option value="">Select Region</option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <label>Logo (Optional)</label>
                    </div>
                    <div class="col-md-6 col-sm-7">
                        <input type="file" id="picture" name="picture" class="form-field">
                        @error('picture')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
