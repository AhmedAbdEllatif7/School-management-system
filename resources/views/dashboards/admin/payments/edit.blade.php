@extends('layouts.master')
@section('css')
@section('title')
    {{trans('Students_trans.payments_student_edit')}}
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
    {{trans('Students_trans.payments_student_edit')}} : <label style="color: red">{{$studentPayment->student->name}}</label>

    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                            <form action="{{route('student-payments.update' , 'error')}}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>    {{trans('Students_trans.Amount')}} : <label style="color: red">{{$studentPayment->student->name}}</label>
                                            : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="Debit" value="{{$studentPayment->amount}}" type="number" >
                                        <input  type="hidden" name="student_id" value="{{$studentPayment->student->id}}" class="form-control">
                                        <input  type="hidden" name="id"  value="{{$studentPayment->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>    {{trans('Students_trans.statement')}} : <label style="color: red">{{$studentPayment->student->name}}</label>
                                            : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$studentPayment->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
