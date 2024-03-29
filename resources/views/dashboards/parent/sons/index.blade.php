@extends('layouts.master')
@section('css')
    @section('title')
        {{trans('main_trans.sons_list')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.sons_list')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if(session('error_degree'))
        <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error_degree') }}
        </div>
    @endif
    @if(session('error_code_degree'))
        <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('error_code_degree') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
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
                                        @foreach($sons as $son)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$son->name}}</td>
                                                <td>{{$son->email}}</td>
                                                <td>{{$son->gender->name}}</td>
                                                <td>{{$son->grade->name}}</td>
                                                <td>{{$son->classroom->name}}</td>
                                                <td>{{$son->section->name}}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{trans('main_trans.processes')}}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" href="{{route('view.exam.result',$son->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;{{trans('main_trans.view_exam_results')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
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
