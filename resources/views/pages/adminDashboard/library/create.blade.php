@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.add_new_book')}}
        @stop
        @section('PageTitle')
            {{trans('main_trans.add_new_book')}}
        @stop
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
                                <form action="{{route('libraries.store' , 'test')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">

                                        <div class="col">
                                            <label for="title">{{trans('main_trans.book_name')}}</label>
                                            <input type="text" name="title" class="form-control">
                                        </div>

                                    </div>
                                    <br>

                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                    @foreach($grades as $grade)
                                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('grade_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }}: <span class="text-danger">*</span></label>
                                                <select class="custom-select mr-sm-2" name="classroom_id" required>
                                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                </select>
                                                @error('classroom_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                                <select class="custom-select mr-sm-2" name="section_id">

                                                </select>
                                            </div>
                                        </div>

                                    </div><br>
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="academic_year">{{trans('main_trans.attachments')}} : <span class="text-danger">*</span></label>
                                                <input type="file" accept="application/pdf" name="file_name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
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
