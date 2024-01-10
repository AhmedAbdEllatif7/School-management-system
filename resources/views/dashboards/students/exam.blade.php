
@extends('layouts.master')
@section('css')
    @section('title')
       {{trans('main_trans.quizzes')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.quizzes')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if(session('exam_done'))
        <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('exam_done') }}
        </div>
    @endif

    @if(session('test_cancelled'))
        <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('test_cancelled') }}
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
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('main_trans.Subject_name')}}</th>
                                            <th>{{trans('main_trans.quiz_name')}}</th>
                                            <th>{{trans('main_trans.enter')}}\{{trans('main_trans.quiz_degree')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>
                                                    @if(isset($quizze) && $quizze->degree->count() > 0 && isset($quizze->degree[0]->score))
                                                        {{$quizze->degree[0]->score}}/{{$quizze->questions->sum('score')}}
                                                    @else
                                                        <a href="{{ route('student_exams.show', isset($quizze) ? $quizze->id : '') }}"
                                                           class="btn btn-outline-success btn-sm" role="button" aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i>
                                                        </a>
                                                    @endif


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


        <script>
            function alertAbuse() {
                alert("برجاء عدم إعادة تحميل الصفحة بعد دخول الاختبار - في حال تم تنفيذ ذلك سيتم الغاء الاختبار بشكل اوتوماتيك ");
            }
        </script>

@endsection
