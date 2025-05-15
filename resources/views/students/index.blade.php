@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="form-wrapper">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-xs-6">
                    <h3 class="box-title">Students</h3>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-6">
                    <div class="main-action-box">
                        <a href="{{ route('students.create') }}" class="primary-btn mb-3">Add New</a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered table-hover student-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <!-- <th>Degree</th> -->
                        <!-- <th>Graduated From</th> -->
                        <th style="width: 100px;">Test</th>
                        <th style="padding: 0px;">
                            <table class="inner-border-only" style="width:100%;">
                                <tr>
                                    <td style="width: 70px;">Intake</td>

                                    <td>University</td>
                                    <td style="width: 148px;">Course</td>
                                    <td style="width: 98px;">Status</td>
                                </tr>
                            </table>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('students.show', $student) }}">
                                {{ $student->name }}
                            </a>
                        </td>
                        <!-- <td>{{ $student->qualification->name }}</td> -->
                        <!-- <td>{{ $student->graduated_from }}</td> -->
                        <td>{{ $student->test }}</td>
                        <td style="padding: 0px;">
                            <table class="inner-border-only" style="width:100%;">
                                @foreach ($student->preferences as $preference)
                                <tr>
                                    <td style="width: 70px;">{{ $preference->intake->name }}</td>
                                    <td>{{ $preference->university->name }}</td>
                                    <td style="width: 148px;"> {{ $preference->course }}</td>
                                    <td style="width: 98px;"> <span class="badge bg-info">{{ $preference->status->name }}</span></td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><br>
    </div>
    <style>
        .student-table {
            font-size: 13px;
        }

        .inner-border-only {
            border-collapse: collapse;
        }

        .inner-border-only td {
            padding-top: 4px;
            padding-left: 4px;
            padding-bottom: 4px;
            border: 1px solid #ddd;
        }

        /* Remove outer borders */
        .inner-border-only tr:first-child td {
            border-top: none;
        }

        .inner-border-only tr:last-child td {
            border-bottom: none;
        }

        .inner-border-only tr td:first-child {
            border-left: none;
        }

        .inner-border-only tr td:last-child {
            border-right: none;
        }
    </style>
    @endsection