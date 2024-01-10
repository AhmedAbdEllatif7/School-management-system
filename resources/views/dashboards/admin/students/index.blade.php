    @extends('layouts.master')
    @section('css')
    @section('title')
        {{trans('main_trans.Student List')}}
    @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.Student List')}}
    @stop
    <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row">

            @if(session('updateStudent'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('updateStudent') }}
                </div>
            @endif

                @if(session('deleteStudent'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('deleteStudent') }}
                </div>
            @endif
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{trans('main_trans.add_student')}}</a><br><br>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('Students_trans.name')}}</th>
                                                <th>{{trans('Students_trans.email')}}</th>
                                                <th>{{trans('Students_trans.gender')}}</th>
                                                <th>{{trans('Students_trans.Grade')}}</th>
                                                <th>{{trans('Students_trans.classrooms')}}</th>
                                                <th>{{trans('Students_trans.section')}}</th>
                                                <th>{{trans('Students_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($students as $student)
                                                <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->gender->name}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                    <td>
                                                        <div class="dropdown show">
                                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{ trans('Students_trans.operations') }}
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="{{route('students.show', $student->id) }}"><i style="color: #ffc107" class="fa fa-eye"></i>&nbsp; {{ trans('Students_trans.view_student_data') }}</a>
                                                                <a class="dropdown-item" href="{{route('students.edit', $student->id) }}"><i style="color:green" class="fa fa-edit"></i>&nbsp; {{ trans('Students_trans.edit_student_data') }}</a>
                                                                <a class="dropdown-item" href="{{route('invoices-fees.show', $student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{ trans('Students_trans.add_invoice_fee') }}</a>
                                                                <a class="dropdown-item" href="{{route('student-receipt.show', $student->id)}}"><i style="color: #9dc8e2" class="fa fa-money"></i>&nbsp; {{ trans('Students_trans.add_receipt') }}</a>
                                                                <a class="dropdown-item" href="{{route('processing-fees.show', $student->id)}}"><i style="color: red" class="fa fa-money"></i>&nbsp; {{ trans('Students_trans.exclude_fee') }}</a>
                                                                <a class="dropdown-item" href="{{route('student-payments.show', $student->id)}}"><i style="color:goldenrod" class="fa fa-money"></i>&nbsp; {{ trans('Students_trans.add_payment') }}</a>
                                                                <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp; {{ trans('Students_trans.delete_student_data') }}</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @include('pages.adminDashboard.students.delete')
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row closed -->
    @endsection
    @section('js')
        @toastr_js
        @toastr_render
    @endsection
