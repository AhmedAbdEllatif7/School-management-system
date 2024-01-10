@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('students_trans.Fees')}}
        @stop
        @endsection
        @section('page-header')
            <!-- breadcrumb -->
        @section('PageTitle')
            {{trans('students_trans.Fees')}}
        @stop
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row">
            @if(session('update_fees'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('update_fees') }}
                </div>
            @endif

            @if(session('delete_fees'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('delete_fees') }}
                </div>
            @endif

            <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('fees.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('students_trans.add_new_fees')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>{{ trans('#') }}</th>
                                            <th>{{ trans('students_trans.Name') }}</th>
                                            <th>{{ trans('students_trans.Amount') }}</th>
                                            <th>{{ trans('students_trans.Grade') }}</th>
                                            <th>{{ trans('students_trans.Classroom') }}</th>
                                            <th>{{ trans('students_trans.Academic Year') }}</th>
                                            <th>{{ trans('students_trans.Notes') }}</th>
                                            <th>{{ trans('students_trans.Actions') }}</th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->title}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$fee->grades->name}}</td>
                                            <td>{{$fee->classrooms->name}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->description}}</td>
                                                <td>
                                                    <a href="{{ route('fees.edit',  $fee->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('students_trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('students_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('dashboards.admin.fees.delete')
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

    @endsection
