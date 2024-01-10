@extends('layouts.master')
    @section('css')
        @section('title')
            {{ trans('main_trans.Student List') }}
        @stop
        @section('PageTitle')
            {{ trans('main_trans.Student List') }}
        @stop
    @endsection
    @section('content')
        <!-- row -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('status') }}</li>
                </ul>
            </div>
        @endif
        @if(session('add_done'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('add_done') }}
            </div>
        @endif
        @if(session('edit_done'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('edit_done') }}
            </div>
        @endif
        <h5 style="font-family: 'Cairo', sans-serif;color: red"> {{ trans('Students_trans.today_date') }}: {{ date('Y-m-d') }}</h5>
        <br>
        <P>
            <a href="{{ route('attendance.index') }}" class="btn btn-success">{{ trans('Students_trans.attendance') }}</a>
        </P>
        <br>
        <form method="post" action="{{route('attendance.store')}}">
            @csrf
            <table id="datatable" class="table table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('main_trans.name') }}</th>
                    <th>{{ trans('main_trans.Classroom') }}</th>
                    <th>{{ trans('main_trans.grade') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($sections && count($sections) > 0)
                    @foreach($sections as $section)
                        <tr>
                            <td colspan="4" class="alert-info">{{ $section->name }} Section</td>
                        </tr>
                        @if($section->students && count($section->students) > 0)
                            @foreach($section->students as $student)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->classroom->name }}</td>
                                    <td>{{ $student->grade->name }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No students found in this section.</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No sections found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </form>
        <!-- row closed -->
    @endsection
    @section('js')

    @endsection
