<!-- resources/views/portals/index.blade.php -->
@extends('layouts.main')
@section('title', 'Portals')
@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	    <div class="form-wrapper">
			<div class="row">
				<div class="col-md-6 col-sm-8 col-xs-6">
					<h3 class="box-title">Portals</h3>	
				</div>
				<div class="col-md-6 col-sm-4 col-xs-6">
				<div class="main-action-box">
                    <a href="{{ route('portals.create') }}" class="primary-btn">Create New</a>
				</div>
			</div>
		</div>
		<table class="table table-striped table-hover">
            <thead>
				<tr>
					<th style="width: 12px;">#</th>
					<th>Logo</th>
					<th>Name</th>
                    <th>URL</th>
                    <th>Action</th>
				</tr>
			</thead>
		    <tbody>
                @foreach ($portals as $portal)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img class="img-circle" width="40" height="40" src="{{ asset('uploads/'.$portal->image) }}" alt="{{ $portal->name }}"></td>
                    <td>{{ $portal->name }}</td>
                    <td></td>
                    <td>
                        <a href="{{ route('portals.edit', $portal->id) }}" class="sm-primary-btn">Edit</a>
                        <form action="{{ route('portals.destroy', $portal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="sm-delete-btn"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>						
	</div><br>
</div>
@endsection
