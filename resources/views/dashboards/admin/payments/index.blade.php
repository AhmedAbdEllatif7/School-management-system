@extends('layouts.master')
@section('css')
@section('title')
    {{trans('Students_trans.payments_student_list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.payments_student_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row">

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


          @if(session('delete_done'))
                        <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('delete_done') }}
                        </div>
                    @endif

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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.Name')}}</th>
                                            <th>{{trans('Students_trans.Amount')}}</th>
                                            <th>{{trans('Students_trans.description')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($studentPayments as $studentPayment)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$studentPayment->student->name}}</td>
                                            <td>{{ number_format($studentPayment->amount, 2) }}</td>
                                            <td>{{$studentPayment->description}}</td>
                                                <td>
                                                    <a href="{{route('student-payments.edit' , $studentPayment->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$studentPayment->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('dashboards.admin.payments.delete')
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
