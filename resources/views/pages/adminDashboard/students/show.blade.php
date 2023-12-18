@extends('layouts.master')
@section('css')
@section('title')
    {{trans('students_trans.Student_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('students_trans.Student_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        @if(session('add_attachment'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('add_attachment') }}
            </div>
        @endif



        @if(session('error_file'))
                    <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('error_file') }}
                    </div>
                @endif


            @if(session('delete_attachment'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('delete_attachment') }}
                </div>
            @endif

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{trans('students_trans.Student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{trans('students_trans.Attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                    aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('students_trans.name_ar')}}</th>
                                            <td>{{$student->getTranslation('name' ,'ar') }}</td>
                                            <th scope="row">{{trans('students_trans.name_en')}}</th>
                                            <td>{{$student->getTranslation('name' ,'en') }}</td>
                                            <th scope="row">{{trans('students_trans.email')}}</th>
                                            <td>{{$student->email}}</td>
                                            <th scope="row">{{trans('students_trans.gender')}}</th>
                                            <td>{{$student->gender->name}}</td>
                                            <th scope="row">{{trans('students_trans.Nationality')}}</th>
                                            <td>{{$student->Nationality->name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('students_trans.Grade')}}</th>
                                            <td>{{ $student->grade->name }}</td>
                                            <th scope="row">{{trans('students_trans.classrooms')}}</th>
                                            <td>{{$student->classroom->name}}</td>
                                            <th scope="row">{{trans('students_trans.section')}}</th>
                                            <td>{{$student->section->name}}</td>
                                            <th scope="row">{{trans('students_trans.Date_of_Birth')}}</th>
                                            <td>{{ $student->date_birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('students_trans.parent')}}</th>
                                            <td>{{ $student->myparent->father_name}}</td>
                                            <th scope="row">{{trans('students_trans.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                    aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">


                                            <form method="post" action="{{route('students.upload.photo')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('students_trans.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photo"  required>
                                                        <input type="hidden" name="student_id" value="{{$student->id}}">
                                                        <input type="hidden" name="email" value="{{$student->email}}">
                                                        <input type="hidden" name="email" value="{{$student->email}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                    {{trans('students_trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                            style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('students_trans.filename')}}</th>
                                                <th scope="col">{{trans('students_trans.created_at')}}</th>
                                                <th scope="col">{{trans('students_trans.photo')}}</th>
                                                <th scope="col">{{trans('students_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach( $student->images as $image)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$image->filename}}</td>
                                                    <td>{{$image->created_at->diffForHumans()}}</td>
                                                    <td> <div class="col-md-3 mb-3">
                                                            <img src="{{ asset('attachments/students/' . $student->email . '/' . $image->filename) }}" alt="Student Image" style="width:100px; height:100px;">
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                        href="{{url('download_attachments')}}/{{ $image->imageable->name }}/{{$image->filename}}"
                                                        role="button"><i class="fas fa-download"></i>&nbsp; {{trans('students_trans.Download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $image->id }}"
                                                                title="{{ trans('Grades_trans.Delete') }}"><i class="fas fa-trash"></i>&nbsp;{{trans('teacher_trans.delete')}}
                                                        </button>

                                                        <a href="{{url('view_file')}}/{{ $image->imageable->name }}/{{$image->filename}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="{{ trans('students_trans.View') }}"><i class="far fa-eye"></i></a>

                                                    </td>
                                                </tr>
                                                @include('pages.adminDashboard.students.deletePhoto')
                                            @endforeach
                                            </tbody>
                                        </table>
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


@endsection
