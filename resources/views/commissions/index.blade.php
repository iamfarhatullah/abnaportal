@extends('layouts.main')
@section('title', 'Commissions')
@section('content')
<div class="form-wrapper">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<h3 class="box-title">Commissions List</h3>	
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="main-action-box">
				<a href="{{route('commissions.edit')}}" class="primary-btn">Edit All</a>
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
                <th scope="col" style="width:3%">#</th>
                <th scope="col" style="width:9%">Country</th>
                <th scope="col" style="width:40%">University</th>
                @foreach($portals as $portal)
                    <!-- <th scope="col" style="width:6%">{{ $portal->name }}</th> -->
                     <td style="width:6%"><img class="img-circle" width="28" height="28" src="{{ asset('uploads/'.$portal->image) }}" alt="{{ $portal->name }}"></td>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($universities as $university)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $university->country->name }}</td>
                <td>{{ $university->name }}</td>
                @foreach($portals as $portal)
                    <td>
                        {{ $university->commissions->where('portal_id', $portal->id)->first()->commission_percentage ?? '0' }} {{' %'}}
                    </td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
