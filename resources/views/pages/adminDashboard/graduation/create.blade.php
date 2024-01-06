@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.add_Graduate')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_Graduate')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if (Session::has('error_Graduated'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{Session::get('error_Graduated')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
            @if (Session::has('error_Graduated'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('error_Graduated')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('error')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('graduated'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{Session::get('graduated')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{ route('graduation.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                                <select class="custom-select mr-sm-2 @error('grade_id') is-invalid @enderror" name="grade_id" required>
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('classroom_id') is-invalid @enderror" name="classroom_id" required>
                                    <!-- Options for classroom -->
                                </select>
                                @error('classroom_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                <select class="custom-select mr-sm-2 @error('section_id') is-invalid @enderror" name="section_id" required>
                                    <!-- Options for section -->
                                </select>
                                @error('section_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ trans('main_trans.Submit') }}</button>
                    </form>
                    
                    <br><br>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{trans('Students_trans.add_graduated_students')}}</label><br>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                {{trans('Students_trans.add_student')}}
                            </button>
                        </div>
                    </div>

                    <!-- add_selected_graduated_modal_class -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                        {{ trans('classes_trans.add_class') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class=" row mb-30" action="{{route('graduate.selected')}}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="repeater">
                                                <div data-repeater-list="listOfStudents">
                                                    <div data-repeater-item>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Name" class="mr-sm-2">{{ trans('Students_trans.student_name') }}:</label>
                                                                <select class="custom-select mr-sm-2" name="student_id"  >
                                                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                                    @foreach($students as $student)
                                                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name" class="mr-sm-2">{{ trans('Students_trans.Email') }}:</label>
                                                                <select class="custom-select mr-sm-2" name="email"  >
                                                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                                @foreach($students as $student)
                                                                        <option value="{{ $student->email }}">{{ $student->email }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('classes_trans.Processes') }}
                                                                    :</label>
                                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                                    type="button" value="{{ trans('classes_trans.delete_row') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-20">
                                                    <div class="col-12">
                                                        <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_row') }}"/>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-success">{{ trans('main_trans.Submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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



    @include('layouts.ajax')


@endsection
