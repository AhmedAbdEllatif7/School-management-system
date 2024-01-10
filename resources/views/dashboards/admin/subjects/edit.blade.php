    @extends('layouts.master')
    @section('css')
    @section('title')
        {{ trans('main_trans.edit_Subjects') }}
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
                                <form action="{{route('subjects.update' , 'test') }}" method="post" autocomplete="off">
                                    {{ method_field('patch') }}
                                    @csrf
                                    <div class="form-row">
                                        <div class="col">
                                            <label for="title">{{ trans('Students_trans.subject_name_arabic') }}</label>
                                            <input type="text" name="name_ar"
                                                value="{{ $subject->getTranslation('name', 'ar') }}"
                                                class="form-control">
                                            <input type="hidden" name="id" value="{{$subject->id}}">
                                        </div>
                                        <div class="col">
                                            <label for="title">{{ trans('Students_trans.subject_name_english') }}</label>
                                            <input type="text" name="name_en"
                                                value="{{ $subject->getTranslation('name', 'en') }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('Students_trans.educational_stage') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option
                                                        value="{{$grade->id}}" {{$grade->id == $subject->grade_id ?'selected':''}}>{{$grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('Students_trans.class') }}</label>
                                            <select name="classroom_id" class="custom-select">
                                                <option
                                                    value="{{ $subject->classroom->id }}">{{ $subject->classroom->name }}
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col">
                                            <label for="inputState">{{ trans('Students_trans.teacher_name') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($teachers as $teacher)
                                                    <option
                                                        value="{{$teacher->id}}" {{$teacher->id == $subject->teacher_id ?'selected':''}}>{{$teacher->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('Students_trans.save_data') }}
                                    </button>
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
