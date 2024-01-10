@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.attendance_report')}}
        @stop
        @section('PageTitle')
            {{trans('main_trans.attendance_report')}}
        @stop
    @stop
        @section('content')
            <!-- row -->
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <form method="GET" action = "{{route('reports.search')}}" autocomplete="off">
                                    @csrf
                                    <h6 style="font-family: 'Cairo', sans-serif; color: blue">{{ trans('main_trans.attendance_information') }}</h6><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="student">{{ trans('main_trans.Students') }}</label>
                                                <select class="custom-select mr-sm-2" name="student_id">
                                                    <option value="0">{{ trans('main_trans.all') }}</option>
                                                    @foreach($students as $student)
                                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="from">{{ trans('main_trans.start_date') }}</label>
                                                <input type="date" class="form-control" name="from" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="to">{{ trans('main_trans.end_date') }}</label>
                                                <input type="date" class="form-control" name="to" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-middle" type="submit">{{ trans('teacher_trans.search') }}</button>
                                </form>
                                <br>
                                <br>
                                <br>
                            @isset($searchResult)
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-success">#</th>
                                            <th class="alert-success">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.section')}}</th>
                                            <th class="alert-success">{{trans('main_trans.date')}}</th>
                                            <th class="alert-warning">{{trans('main_trans.statue')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($searchResult as $student)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$student->students->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>{{$student->attendance_date}}</td>
                                                <td>

                                                    @if($student->attendance_status == 0)
                                                        <span class="btn-danger">{{trans('Students_trans.absence')}}</span>
                                                    @else
                                                        <span class="btn-success">{{trans('Students_trans.Presence')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        @endsection
        @section('js')

        @endsection
