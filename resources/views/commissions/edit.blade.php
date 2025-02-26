@extends('layouts.main')
@section('title', 'Commissions')
@section('content')

<div class="form-wrapper">
    <form action="{{ route('commissions.updateAll') }}" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h3 class="box-title">Commissions List</h3>	
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="main-action-box">
                <button type="submit" class="success-btn">Save All</button>
                </div>
            </div>
        </div>			
        <div class="row">
            <div class="col-md-12">
                <input type="text" id="searchInput" onkeyup="searchTable()" class="form-field" placeholder="Search for universities or countries...">
            </div>
        </div>
        @csrf
        @method('POST')
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
                                <input type="number" class="percentage-field" name="commissions[{{ $university->id }}][{{ $portal->id }}]"
                                       value="{{ $university->commissions->where('portal_id', $portal->id)->first()->commission_percentage ?? '0' }}"
                                       class="form-control" step="0.01">
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>
@endsection
