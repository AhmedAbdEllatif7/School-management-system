@extends('layouts.master')
@section('css')
    @section('title')
        {{trans('main_trans.teacher_details')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.teacher_details')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">




        @if(session('delete_attachment'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('delete_attachment') }}
            </div>
        @endif


        @if(session('not_found'))
            <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('not_found') }}
            </div>
        @endif


        @if(session('add_photo'))
        <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('add_photo') }}
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
                                        aria-selected="true">{{trans('main_trans.teacher_details')}}</a>
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
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{trans('teacher_trans.name')}}</th>
                                            <th scope="col">{{trans('teacher_trans.email')}}</th>
                                            <th scope="col">{{trans('teacher_trans.gender_id')}}</th>
                                            <th scope="col">{{trans('teacher_trans.specialization')}}</th>
                                            <th scope="col">{{trans('teacher_trans.joining_date')}}</th>
                                            <th scope="col">{{trans('teacher_trans.address')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{$teacher->id}}</th>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td>{{$teacher->genders->name}}</td>
                                            <td>{{$teacher->specializations->name}}</td>
                                            <td>{{$teacher->joining_date}}</td>
                                            <td>{{$teacher->address}}</td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"

                                        aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">                                        
                                            
                                            <form method="post" action="{{route('teacher.upload.photo')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('students_trans.Attachments')}}
                                                                    : <span class="text-danger">*</span></label>
                                                                <input type="file" accept="image/*" name="photo" multiple required>
                                                                {{-- <input type="hidden" name="teacher_name" value="{{$teacher->name}}"> --}}
                                                                <input type="hidden" name="email" value="{{$teacher->email}}">
                                                                <input type="hidden" name="teacher_id" value="{{$teacher->id}}">
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
                                            @foreach($teacher->images as $image)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$image->filename}}</td>
                                                    <td>{{$image->created_at->diffForHumans()}}</td>
                                                    <td> <div class="col-md-3 mb-3">
                                                            <img src="{{ asset('attachments/teachers/' . $teacher->email . '/' . $image->filename) }}" alt="Teacher Image" style="width:100px; height:100px;">
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-success btn-sm"
                                                            href="{{route('teacher.open.photo' , ['teacherEmail' => $teacher->email , 'fileName' => $image->filename])}}"
                                                            role="button"><i class="fas fa-eye"></i>&nbsp; {{trans('teacher_trans.view')}}
                                                        </a>

                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{route('download.teacher.photo' , ['teacherEmail' => $teacher->email , 'fileName' => $image->filename])}}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp; {{trans('teacher_trans.Download')}}
                                                        </a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $image->id }}"
                                                                title="{{ trans('Grades_trans.Delete') }}"><i class="fas fa-trash"></i>&nbsp;{{trans('teacher_trans.delete')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.adminDashboard.teachers.deletePhoto')
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