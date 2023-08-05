@extends('layouts.master')
@section('css')
@section('title')
    {{trans('Students_trans.Student_Edit')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.Student_Edit')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
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

                    <form action="{{ url('update_student') }}" method="post" autocomplete="off">
                        @method('POST')
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('Students_trans.personal_information') }}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.name_ar') }} : <span class="text-danger">*</span></label>
                                    <input value="{{ $Students->getTranslation('name','ar') }}" type="text" name="name_ar" class="form-control" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="id" value="{{ $Students->id }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.name_en') }} : <span class="text-danger">*</span></label>
                                    <input value="{{ $Students->getTranslation('name','en') }}" class="form-control" name="name_en" type="text" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.email') }} :</label>
                                    <input type="email" value="{{ $Students->email }}" name="email" class="form-control">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.password') }} :</label>
                                    <input value="{{ $Students->password }}" type="password" name="password" class="form-control">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{ trans('Students_trans.gender') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($Genders as $Gender)
                                            <option value="{{ $Gender->id }}" {{ $Gender->id == $Students->gender_id ? 'selected' : '' }}>{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{ trans('Students_trans.Nationality') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($nationals as $nal)
                                            <option value="{{ $nal->id }}" {{ $nal->id == $Students->nationalitie_id ? 'selected' : '' }}>{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationalitie_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{ trans('Students_trans.blood_type') }} :</label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($bloods as $bg)
                                            <option value="{{ $bg->id }}" {{ $bg->id == $Students->blood_id ? 'selected' : '' }}>{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.Date_of_Birth') }} :</label>
                                    <input class="form-control" type="text" value="{{ $Students->date_birth }}" id="datepicker-action" name="Date_Birth" data-date-format="yyyy-mm-dd">
                                    @error('Date_Birth')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('Students_trans.Student_information') }}</h6><br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Grade_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($Grades as $Grade)
                                            <option value="{{ $Grade->id }}" {{ $Grade->id == $Students->grade_id ? 'selected' : '' }}>{{ $Grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Grade_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id" required>
                                        <option value="{{ $Students->classroom_id }}">{{ $Students->classroom->name }}</option>
                                    </select>
                                    @error('Classroom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('Students_trans.section') }} :</label>
                                    <select class="custom-select mr-sm-2" name="section_id">
                                        <option value="{{ $Students->section_id }}"> {{ $Students->section->name }}</option>
                                    </select>
                                    @error('section_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{ trans('Students_trans.parent') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == $Students->parent_id ? 'selected' : '' }}>{{ $parent->Name_Father }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year }}" {{ $year == $Students->academic_year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('academic_year')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div><br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('Students_trans.submit') }}</button>
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
    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="Classroom_id"]').empty();
                            $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');

                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
