<!-- resources/views/portals/show.blade.php -->
@extends('layouts.main')
@section('title', 'Portal Details')
@section('content')
<h1>{{ $portal->name }}</h1>
<img src="{{ asset('uploads/'.$portal->image) }}" width="300" alt="{{ $portal->name }}">

<div class="mt-3">
    <a href="{{ route('portals.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('portals.edit', $portal->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection