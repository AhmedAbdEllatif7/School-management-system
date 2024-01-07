@extends('layouts.master')
@section('css')
@section('title')
    {{trans('Students_trans.edit_proceessing_fee')}}
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
        {{trans('Students_trans.edit_proceessing_fee')}}
        : <label style="color: red">{{$processingFee->student->name}}</label>
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

                            <form action="{{route('processing-fees.update' , 'error')}}" method="post" autocomplete="off">
                                @method('PUT')

                                @csrf
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('Students_trans.Amount')}} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="amount" value="{{$processingFee->amount}}" type="number" required>
                                        <input  type="hidden" name="student_id" value="{{$processingFee->student->id}}" class="form-control">
                                        <input  type="hidden" name="id"  value="{{$processingFee->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{trans('Students_trans.description')}} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$processingFee->description}}</textarea>
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
    @toastr_js
    @toastr_render

@endsection
