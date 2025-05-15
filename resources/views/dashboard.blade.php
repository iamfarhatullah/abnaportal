@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <x-info-tile title="Universities" icon="fas fa-university" count="{{ $totalUniversities }}" />
    <x-info-tile title="Portals" icon="fas fa-window-restore" count="{{ $totalPortals }}" />
    <x-info-tile title="Users" icon="fas fa-user-friends" count="{{ $totalUsers }}" />
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Just checking if it works or not</h2>
    </div>
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
<div id="university-data" data-universities='@json($universities)'></div>

<style>
    #suggestionList {
        position: absolute;
        z-index: 1000;
        width: 93%;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 0px;
    }

    #suggestionList .list-group-item:hover {
        background-color: #f0f0f0;
    }

    #suggestionList .active {
        background-color: #2a3f54;
        color: white;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('universitySearchInput');
        const suggestionList = document.getElementById('suggestionList');
        const submitButton = document.getElementById('submitButton');
        const universities = JSON.parse(document.getElementById('university-data').dataset.universities);

        let selectedUniversity = null;
        let currentFocus = -1;

        function closeSuggestions() {
            suggestionList.style.display = 'none';
            suggestionList.innerHTML = '';
            currentFocus = -1;
        }

        function highlightItem(index) {
            const items = suggestionList.querySelectorAll('li');
            items.forEach((item, i) => {
                item.classList.toggle('active', i === index);
            });
        }

        function selectItem(index) {
            const items = suggestionList.querySelectorAll('li');
            if (items[index]) {
                searchInput.value = items[index].textContent;
                selectedUniversity = universities.find(u => u.name === items[index].textContent);
                submitButton.disabled = !selectedUniversity;
                closeSuggestions();
            }
        }

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase().trim();
            if (!query) return closeSuggestions();

            const filtered = universities.filter(u => u.name.toLowerCase().includes(query)).slice(0, 5);
            suggestionList.innerHTML = '';

            if (filtered.length > 0) {
                filtered.forEach((university, index) => {
                    const li = document.createElement('li');
                    li.textContent = university.name;
                    li.classList.add('list-group-item', 'list-group-item-action');
                    li.style.cursor = 'pointer';
                    li.addEventListener('click', () => {
                        searchInput.value = university.name;
                        selectedUniversity = university;
                        submitButton.disabled = false;
                        closeSuggestions();
                    });
                    suggestionList.appendChild(li);
                });
                suggestionList.style.display = 'block';
            } else {
                closeSuggestions();
            }
        });

        searchInput.addEventListener('keydown', function(e) {
            const items = suggestionList.querySelectorAll('li');
            if (!items.length) return;

            if (e.key === 'ArrowDown') {
                currentFocus = (currentFocus + 1) % items.length;
                highlightItem(currentFocus);
                e.preventDefault();
            } else if (e.key === 'ArrowUp') {
                currentFocus = (currentFocus - 1 + items.length) % items.length;
                highlightItem(currentFocus);
                e.preventDefault();
            } else if (e.key === 'Enter') {
                if (currentFocus >= 0) {
                    e.preventDefault();
                    selectItem(currentFocus);
                }
            }
        });

        document.addEventListener('click', function(event) {
            if (!searchInput.contains(event.target) && !suggestionList.contains(event.target)) {
                closeSuggestions();
            }
        });
    });
</script>

@endsection