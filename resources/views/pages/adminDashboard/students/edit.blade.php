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
                                    <input type="email" value="{{ $student->email }}" name="email" class="form-control" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('Students_trans.password') }} :</label>
                                    <input value="{{ $student->password }}" type="password" name="password" class="form-control" required>
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
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $gender->id == $student->gender_id ? 'selected' : '' }}>{{ $gender->name }}</option>
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
                                        @foreach($nationals as $national)
                                            <option value="{{ $national->id }}" {{ $national->id == $student->nationalitie_id ? 'selected' : '' }}>{{ $national->name }}</option>
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
                                    <select class="custom-select mr-sm-2" name="blood_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}" {{ $bloodType->id == $student->blood_id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
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
                                    <input class="form-control" type="text" value="{{ $student->date_birth }}" id="datepicker-action" name="date_birth" data-date-format="yyyy-mm-dd" required>
                                    @error('date_birth')
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
                                    <select class="custom-select mr-sm-2" name="grade_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ $grade->id == $student->grade_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id" required>
                                        <option value="{{ $student->classroom_id }}">{{ $student->classroom->name }}</option>
                                    </select>
                                    @error('classroom_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{ trans('Students_trans.section') }} :</label>
                                    <select class="custom-select mr-sm-2" name="section_id" required>
                                        <option value="{{ $student->section_id }}"> {{ $student->section->name }}</option>
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
                                            <option value="{{ $parent->id }}" {{ $parent->id == $student->parent_id ? 'selected' : '' }}>{{ $parent->father_name }}</option>
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
                                            <option value="{{ $year }}" {{ $year == $student->academic_year ? 'selected' : '' }}>{{ $year }}</option>
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
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('get-classrooms') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');

                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
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
            $('select[name="classroom_id"]').on('change', function () {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('get-sections') }}/" + classroom_id,
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
