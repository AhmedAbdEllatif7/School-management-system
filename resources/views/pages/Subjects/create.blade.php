@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Students_trans.add_subject') }}@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.add_subject') }}@stop
<!-- breadcrumb -->
@endsection
@section('content')
    @if(session('add_done'))
        <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('add_done') }}
        </div>
    @endif
    <!-- row -->
    <div class="row">



        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('subjects.store')}}" method="post" autocomplete="on">
                                @csrf

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{ trans('Students_trans.subject_name_arabic') }}</label>
                                        <input type="text" name="Name_ar" class="form-control">
                                    </div>
                                    <div class="col">
                                        <label for="title">{{ trans('Students_trans.subject_name_english') }}</label>
                                        <input type="text" name="Name_en" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('Students_trans.educational_stage') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Grade_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('Students_trans.class') }}</label>
                                        <select name="Classroom_id" class="custom-select"></select>
                                    </div>


                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('Students_trans.teacher_name') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('Students_trans.save_data') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@include('layouts.ajax')
@endsection
