    @extends('layouts.master')
    @section('css')
        @section('title')
    {{trans('Students_trans.invoices_fees')}}
        @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        @section('PageTitle')
            {{trans('Students_trans.invoices_fees')}}
        @stop
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->

        @if(session('error_fee'))
            <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('error_fee') }}
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
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>{{trans('Students_trans.name')}}</th>
                                                <th>{{trans('Students_trans.fee_type')}}</th>
                                                <th>{{trans('Students_trans.amount')}}</th>
                                                <th>{{trans('Students_trans.grade')}}</th>
                                                <th>{{trans('Students_trans.classroom')}}</th>
                                                <th>{{trans('Students_trans.statement')}}</th>
                                                <th>{{trans('Students_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($invoiceFees as $invoiceFee)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$invoiceFee->student->name}}</td>
                                                    <td>{{$invoiceFee->fees->title}}</td>
                                                    <td>{{ number_format($invoiceFee->amount, 2) }}</td>
                                                    <td>{{$invoiceFee->grade->name}}</td>
                                                    <td>{{$invoiceFee->classroom->name}}</td>
                                                    <td>{{$invoiceFee->description}}</td>
                                                    <td>
                                                        <a href="{{route('sons.receipt',$invoiceFee->student_id)}}" title="{{trans('students_trans.receipt')}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class='fas fa-handshake' style='font-size:14px'></i>
                                                        </a>
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