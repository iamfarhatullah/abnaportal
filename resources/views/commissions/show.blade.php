@extends('layouts.main')
@section('title', 'Commissions')
@section('content')
<div class="container">
    <h2>Edit Commission for {{ $commission->university->name }} - {{ $commission->portal->name }}</h2>
    <form action="{{ route('commissions.update', $commission->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="university_id">University</label>
            <select name="university_id" id="university_id" class="form-control">
                @foreach($universities as $university)
                <option value="{{ $university->id }}" {{ $university->id == $commission->university_id ? 'selected' : '' }}>
                    {{ $university->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="portal_id">Portal</label>
            <select name="portal_id" id="portal_id" class="form-control">
                @foreach($portals as $portal)
                <option value="{{ $portal->id }}" {{ $portal->id == $commission->portal_id ? 'selected' : '' }}>
                    {{ $portal->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="commission_percentage">Commission Percentage</label>
            <input type="number" name="commission_percentage" value="{{ $commission->commission_percentage }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Commission</button>
    </form>
</div>
@endsection