@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.manage_promotion')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.manage_promotion')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
    
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                @if(session('retriveAll'))
                                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ session('retriveAll') }}
                                    </div>
                                @endif

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    {{ trans('main_trans.revert_all') }}

                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ trans('main_trans.name') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_stage') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.olde_academic_year') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_grade') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_section') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_stage') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_academic_year') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_grade') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_section') }}</th>
                                            <th class="alert-success">{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>

                                                    @if (!$promotion->student)
                                                        <td>{{$promotion->student()->withTrashed()->first()->name}}</td>
                                                    @endif

                                                @if ($promotion->student)
                                                    <td>{{$promotion->student->name}}</td>
                                                @endif
                                                <td>{{$promotion->fromGrade->name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->fromClassroom->name}}</td>
                                                <td>{{$promotion->fromSection->name}}</td>
                                                <td>{{$promotion->toGrade->name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->toClassroom->name}}</td>
                                                <td>{{$promotion->toSection->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{ trans('main_trans.student_returned') }}
                                                    </button>

                                                </td>
                                            </tr>
                                        @include('pages.adminDashboard.promotion.deleteAll')
                                        @include('pages.adminDashboard.promotion.singleDelete')
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
