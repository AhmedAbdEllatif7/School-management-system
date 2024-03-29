@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Students_trans.invoices_fees_list') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.invoices_fees') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

            @if(session('delete_invoice_fees'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('delete_invoice_fees') }}
                </div>
            @endif

        @if(session('edit_invoice_fees'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('edit_invoice_fees') }}
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
                                            <th>{{ trans('Students_trans.student_name') }}</th>
                                            <th>{{ trans('Students_trans.fee_type') }}</th>
                                            <th>{{ trans('Students_trans.amount') }}</th>
                                            <th>{{ trans('Students_trans.Grade') }}</th>
                                            <th>{{ trans('Students_trans.Classroom') }}</th>
                                            <th>{{ trans('Students_trans.description') }}</th>
                                            <th>{{ trans('classes_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoicesFee as $invoiceFee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$invoiceFee->student->name}}</td>
                                            <td>{{$invoiceFee->fees->title}}</td>
                                            <td>{{ number_format($invoiceFee->amount, 2) }}</td>
                                            <td>{{$invoiceFee->grade->name}}</td>
                                            <td>{{$invoiceFee->classroom->name}}</td>
                                            <td>{{$invoiceFee->description}}</td>
                                                <td>
                                                    <a href="{{ route('invoices-fees.edit' , $invoiceFee->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="{{ trans('students_trans.Edit') }}"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$invoiceFee->id}}" title="{{ trans('students_trans.delete') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('dashboards.admin.invoicesFee.delete')
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
