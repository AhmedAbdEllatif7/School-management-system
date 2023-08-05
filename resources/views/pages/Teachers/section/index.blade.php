@extends('layouts.master')
@section('css')
    @section('title')
        {{trans('main_trans.list_sections')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <h1>{{trans('main_trans.list_sections')}}</h1>
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
                                            <th>{{trans('main_trans.name')}}</th>
                                            <th>{{trans('main_trans.Classroom')}}</th>
                                            <th>{{trans('main_trans.grade')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sections as $section)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$section->name}}</td>
                                                <td>{{$section->classes->name}}</td>
                                                <td>{{$section->grades->name}}</td>
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
