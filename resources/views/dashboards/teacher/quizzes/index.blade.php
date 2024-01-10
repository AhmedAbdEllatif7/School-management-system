@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.quizzes_list')}}
        @stop
        @section('PageTitle')
            {{trans('main_trans.quizzes_list')}}
        @stop
    @endsection
    @section('content')
        <!-- row -->
        <div class="row">

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
                                    <a href="{{route('quizzes.create')}}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{trans('main_trans.add_quiz')}}</a><br><br>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('main_trans.quiz_name')}}</th>
                                                <th>{{trans('main_trans.teacher_name')}}</th>
                                                <th>{{trans('main_trans.subject')}}</th>
                                                <th>{{trans('main_trans.grade')}}</th>
                                                <th>{{trans('main_trans.classroom')}}</th>
                                                <th>{{trans('main_trans.section')}}</th>
                                                <th>{{trans('main_trans.processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($quizzes as $quizze)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>{{$quizze->name}}</td>
                                                    <td>{{$quizze->subject->name}}</td>
                                                    <td>{{$quizze->teacher->name}}</td>
                                                    <td>{{$quizze->grade->name}}</td>
                                                    <td>{{$quizze->classroom->name}}</td>
                                                    <td>{{$quizze->section->name}}</td>
                                                    <td>
                                                        <a href="{{route('quizzes.edit' , $quizze->id)}}" title="{{trans('main_trans.edit')}}"
                                                        class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                                class="fa fa-edit"></i></a>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#delete_exam{{ $quizze->id }}" title="{{trans('main_trans.delete')}}"><i
                                                                class="fa fa-trash"></i></button>

                                                        <a href="{{route('quizzes.show', $quizze->id)}}"
                                                        class="btn btn-warning btn-sm" title="{{trans('main_trans.view_questions')}}" role="button" aria-pressed="true"><i
                                                                class="fa fa-eye"></i></a>

                                                        <a href="{{route('students.examed', $quizze->id)}}"
                                                        class="btn btn-primary btn-sm" title="{{trans('main_trans.view_examed_students')}}" role="button" aria-pressed="true"><i
                                                                class="fa fa-street-view"></i></a>

                                                    </td>
                                                </tr>

                                                <div class="modal fade" id="delete_exam{{$quizze->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="{{route('quizzes.destroy', $quizze->id)}}" method="post">
                                                            {{method_field('delete')}}
                                                            {{csrf_field()}}
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                        class="modal-title" id="exampleModalLabel">{{trans('main_trans.delete_quiz')}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p> {{ trans('Students_trans.are_you_sure_delete') }} {{$quizze->name}}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
                                                                        <button type="submit"
                                                                                class="btn btn-danger">{{ trans('main_trans.delete') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
