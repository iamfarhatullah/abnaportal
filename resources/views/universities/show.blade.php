@extends('layouts.main')
@section('title', 'University Details')
@section('content')
    <div class="container">
        <h2>University Details</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Name: {{ $university->name }}</h3>
                <p><strong>Country:</strong> {{ $university->country->name }}</p>
                @if($university->picture)
                    <img src="{{ asset('storage/' . $university->picture) }}" alt="Picture" width="200">
                @else
                    <p>No picture available</p>
                @endif
            </div>
        </div>
        <a href="{{ route('universities.index') }}" class="btn btn-primary mt-3">Back to List</a>
    </div>
@endsection
