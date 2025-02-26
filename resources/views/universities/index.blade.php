@extends('layouts.main')
@section('title', 'Universities')
@section('content')
        <div class="form-wrapper">
			<div class="row">
				<div class="col-md-6 col-sm-8 col-xs-6">
					<h3 class="box-title">Universities</h3>	
				</div>
				<div class="col-md-6 col-sm-4 col-xs-6">
				    <div class="main-action-box">
                        <a href="{{ route('universities.create') }}" class="primary-btn">Create New</a>
				    </div>
			    </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" id="searchInput" onkeyup="searchTable()" class="form-field" placeholder="Search for universities or countries...">
                </div>
            </div>
            <table id="search-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width: 12px;">#</th>
				    <th scope="col" style="width:7%">Logo</th>
				    <th scope="col" style="width:20%">Country</th>
				    <th scope="col" style="width:58%">Name</th>
				    <th scope="col" style="width:12%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($universities as $university)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                        @if($university->picture && file_exists(public_path($university->picture)))
                            <img src="{{ asset($university->picture) }}" alt="Picture" class="img-circle" width="24" height="24">
                        @else
                            <img src="{{ asset('images/uni.jpg') }}" alt="University" class="img-circle" width="24" height="24">
                        @endif
                        </td>
                        
                        <td>{{ $university->country->name }}</td>
                        <td>{{ $university->name }}</td>
                        <td style="padding: 6px !important;">
                            <a href="{{ route('universities.edit', $university->id) }}" class="sm-primary-btn">Edit</a>
                            <form action="{{ route('universities.destroy', $university->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sm-danger-btn"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection
