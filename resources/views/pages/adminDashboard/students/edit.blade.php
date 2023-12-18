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

                    <form action="{{ route('students.update' , $student->id) }}" method="POST" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ trans('Students_trans.personal_information') }}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.name_ar') }} : <span class="text-danger">*</span></label>
                                    <input value="{{ $student->getTranslation('name','ar') }}" type="text" name="nameAr" class="form-control" required>
                                    @error('nameAr')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="id" value="{{ $student->id }}">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.name_en') }} : <span class="text-danger">*</span></label>
                                    <input value="{{ $student->getTranslation('name','en') }}" class="form-control" name="nameEn" type="text" required>
                                    @error('nameEn')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.email') }} :</label>
                                    <input type="email" value="{{ $student->email }}" name="email" class="form-control">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.password') }} :</label>
                                    <input value="{{ $student->password }}" type="password" name="password" class="form-control">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{ trans('Students_trans.gender') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="genderId" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $gender->id == $student->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('genderId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{ trans('Students_trans.Nationality') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitieId" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($nationals as $national)
                                            <option value="{{ $national->id }}" {{ $national->id == $student->nationalitie_id ? 'selected' : '' }}>{{ $national->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationalitieId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{ trans('Students_trans.blood_type') }} :</label>
                                    <select class="custom-select mr-sm-2" name="bloodId">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}" {{ $bloodType->id == $student->blood_id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('bloodId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.Date_of_Birth') }} :</label>
                                    <input class="form-control" type="text" value="{{ $student->date_birth }}" id="datepicker-action" name="dateBirth" data-date-format="yyyy-mm-dd">
                                    @error('dateBirth')
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
                                    <select class="custom-select mr-sm-2" name="gradeId" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ $grade->id == $student->grade_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gradeId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroomId" required>
                                        <option value="{{ $student->classroom_id }}">{{ $student->classroom->name }}</option>
                                    </select>
                                    @error('classroomId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('Students_trans.section') }} :</label>
                                    <select class="custom-select mr-sm-2" name="sectionId">
                                        <option value="{{ $student->section_id }}"> {{ $student->section->name }}</option>
                                    </select>
                                    @error('sectionId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{ trans('Students_trans.parent') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parentId" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ $parent->id == $student->parent_id ? 'selected' : '' }}>{{ $parent->father_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parentId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academicYear" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year }}" {{ $year == $student->academic_year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('academicYear')
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
            $('select[name="gradeId"]').on('change', function () {
                var gradeId = $(this).val();
                if (gradeId) {
                    $.ajax({
                        url: "{{ URL::to('get-classrooms') }}/" + gradeId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroomId"]').empty();
                            $('select[name="classroomId"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');

                            $.each(data, function (key, value) {
                                $('select[name="classroomId"]').append('<option value="' + key + '">' + value + '</option>');
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
            $('select[name="classroomId"]').on('change', function () {
                var classroomId = $(this).val();
                if (classroomId) {
                    $.ajax({
                        url: "{{ URL::to('get-sections') }}/" + classroomId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="sectionId"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="sectionId"]').append('<option value="' + key + '">' + value + '</option>');
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
