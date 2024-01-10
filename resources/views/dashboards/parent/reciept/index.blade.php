    @extends('layouts.master')
    @section('css')

        @section('title')
            {{ trans('main_trans.receipts') }}
        @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        @section('PageTitle')
            {{ trans('main_trans.receipts') }}
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
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>{{ trans('Students_trans.name') }}</th>
                                                <th>{{ trans('Students_trans.debit') }}</th>
                                                <th>{{ trans('Students_trans.statement') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sonReceipts as $sonReceipt)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$sonReceipt->student->name}}</td>
                                                    <td>{{ number_format($sonReceipt->debit, 2) }}</td>
                                                    <td>{{$sonReceipt->description}}</td>
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
