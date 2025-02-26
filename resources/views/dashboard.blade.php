@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <x-info-tile title="Universities" icon="fas fa-university" count="{{ $totalUniversities }}"/>
        <x-info-tile title="Portals" icon="fas fa-window-restore" count="{{ $totalPortals }}"/>
        <x-info-tile title="Users" icon="fas fa-user-friends" count="{{ $totalUsers }}"/>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-wrapper">
                <h3 class="form-title">Portal finder</h3>
                <div class="row">
                    <form action="{{ route('dashboard.findBestPortal') }}" method="POST">
                        @csrf
                        <div class="col-md-9 col-sm-12">
                            <label class="pull-left">University *</label>    
                            <input type="text" class="form-field" name="university_name" id="universitySearchInput" placeholder="Search for a university..." autocomplete="off" required>
                            <ul id="suggestionList" class="list-group mt-1" style="display: none;"></ul>        
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label style="display: block;">.</label>
                            <input type="submit" name="findBestPortal" class="success-btn pull-right" value="Find Portal" id="submitButton" disabled><br><br>
                        </div>
                    </form>
                </div>
                <hr>
                @if(session('uni-error'))
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>{{ session('uni-error') }}</strong></p>
                    </div>
                </div>
                @endif
                @if(session('search-error'))
                <div class="row">
                    <div class="col-md-12">
                        <p>No record found for <strong>{{ session('search-error') }}</strong></p>
                    </div>
                </div>
                @endif
                @if(isset($commissions))
                <div class="row">
                    <div class="col-md-12">
                        <p>Result for <strong>{{ $university->name }}</strong></p>
                        <div class="row portal-result-box">
                            @foreach($commissions as $commission)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                @php 
                                    $flag = 'red';
                                    $icon = '';
                                    if ($commission->commission_percentage == 0) {
                                        $flag = 'red';
                                        $icon = '<i class="far fa-2x fa-times-circle red"></i>';
                                    } elseif ($commission->commission_percentage > 0 && $loop->index == 0) {
                                        $flag = 'green';
                                        $icon = '<i class="far fa-2x fa-check-circle green"></i>';
                                    } else {
                                        $flag = 'blue';
                                        $icon = '<i class="far fa-2x fa-check-circle blue"></i>';
                                    }
                                @endphp
                                <p class="{{ $flag }}">{{ $commission->portal->name }}</p>
                                {!! $icon !!}
                            </div>
                            @endforeach
                        </div><br>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

<style>
    #suggestionList {
        position: absolute;
        z-index: 1000;
        width: 100%;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 0px;
    }
    #suggestionList .list-group-item:hover {
        background-color: #f0f0f0;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('universitySearchInput');
        const suggestionList = document.getElementById('suggestionList');
        const submitButton = document.getElementById('submitButton');
        let selectedUniversity = null;

        // List of universities (passed from the controller)
        const universities = {!! json_encode($universities) !!};

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase().trim();

            // Clear the dropdown if input is empty
            if (!query) {
                suggestionList.style.display = 'none';
                suggestionList.innerHTML = '';
                return;
            }

            // Filter universities based on input
            const filteredUniversities = universities.filter(university =>
                university.name.toLowerCase().includes(query)
            );

            // Limit the results to 5 universities
            const limitedUniversities = filteredUniversities.slice(0, 5);

            // Clear previous suggestions
            suggestionList.innerHTML = '';

            if (limitedUniversities.length > 0) {
                // Show limited universities in the dropdown
                limitedUniversities.forEach(university => {
                    const listItem = document.createElement('li');
                    listItem.textContent = university.name;
                    listItem.classList.add('list-group-item', 'list-group-item-action');
                    listItem.style.cursor = 'pointer';

                    // On click, populate the input field with the university name
                    listItem.addEventListener('click', function () {
                        searchInput.value = university.name;
                        selectedUniversity = university;
                        suggestionList.style.display = 'none';

                        // Enable the submit button when a university is selected
                        submitButton.disabled = !selectedUniversity;
                    });

                    suggestionList.appendChild(listItem);
                });

                suggestionList.style.display = 'block';
            } else {
                // Hide the dropdown if no matches are found
                suggestionList.style.display = 'none';
            }
        });

        // Hide suggestions when clicking outside the input or dropdown
        document.addEventListener('click', function (event) {
            if (!searchInput.contains(event.target) && !suggestionList.contains(event.target)) {
                suggestionList.style.display = 'none';
            }
        });
    });
</script>
@endsection
