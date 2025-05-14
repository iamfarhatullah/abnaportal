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


    <div class="">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" role="tablist">
            @foreach($countries as $key => $country)
            <li role="presentation" class="{{ $key == 0 ? 'active' : '' }}">
                <a href="#content-{{ $country->id }}"
                    aria-controls="content-{{ $country->id }}"
                    role="tab"
                    data-toggle="tab">
                    {{ $country->name }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="row">
            <div class="col-md-12">
                <input type="text" id="searchInput" onkeyup="searchUniversitiesTable()" class="form-field" placeholder="Search for universities or countries...">
            </div>
        </div>
        <!-- Tab Content -->
        <div class="tab-content">
            @foreach($countries as $key => $country)
            <div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'in active' : '' }}"
                id="content-{{ $country->id }}">
                <ul class="list-group">
                    <table id="search-table" class="table table-striped table-hover searchable-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 12px;">#</th>
                                <th scope="col" style="width:20%">Region</th>
                                <th scope="col" style="width:58%">Name</th>
                                <th scope="col" style="width:12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($universities as $university)
                            @if($country->id == $university->country->id)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $university->region->name }}</td>
                                <td>{{ $university->name }}</td>
                                <td style="padding: 6px !important;">
                                    <a href="{{ route('universities.edit', $university->id) }}" class="sm-primary-btn">Edit</a>
                                    <form action="{{ route('universities.destroy', $university->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sm-delete-btn" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>

                    </table>
                </ul>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection