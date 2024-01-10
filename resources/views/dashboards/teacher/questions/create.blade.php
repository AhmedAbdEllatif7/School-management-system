@extends('layouts.master')
@section('css')
@section('title')
    {{trans('Students_trans.add_new_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.add_new_question')}}
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
                            <form action="{{route('questions.store')}}" method="POST" autocomplete="on">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.th_question_name')}}</label>
                                        <input type="text" name="title" id="input-name"
                                            class="form-control form-control-alternative" autofocus required>
                                        <input type="hidden" name="quizz_id" value="{{$quizz_id}}" id="input-name"
                                            class="form-control form-control-alternative" autofocus required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <p style="color: red">{{trans('main_trans.separator')}}</p>
                                        <label for="title">{{trans('Students_trans.th_answers')}}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1"
                                                rows="4" required></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.th_correct_answer')}}</label>
                                        <input type="text" name="right_answer" id="input-name"
                                            class="form-control form-control-alternative" autofocus required>
                                    </div>
                                </div>
                                <br>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.th_grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score" required>
                                                <option selected disabled> {{trans('main_trans.choose_from_menu')}}...</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-middle" type="submit">{{trans('main_trans.Submit')}}</button>
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

@endsection
