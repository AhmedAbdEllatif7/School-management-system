@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('teacher_trans.Add_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('teacher_trans.Add_Teacher') }}
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

                        @if(session('add_teacher'))
                            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('add_teacher') }}
                            </div>
                        @endif

                        <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('teachers.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Email')}}</label>
                                    <input type="email" name="email" class="form-control" required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Password')}}</label>
                                    <input type="password" name="password" class="form-control" required> 
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Name_ar')}}</label>
                                    <input type="text" name="nameAr" class="form-control" required>
                                    @error('nameAr')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Name_en')}}</label>
                                    <input type="text" name="nameEn" class="form-control" required>
                                    @error('nameEn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('teacher_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id" required>
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    @error('specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('teacher_trans.Gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id" required>
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action" name="joining_date" data-date-format="yyyy-mm-dd" required>
                                    </div>
                                    @error('joining_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('teacher_trans.Address')}}</label>
                                <textarea class="form-control" name="address"
                                        id="exampleFormControlTextarea1" rows="4" required></textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label >{{trans('Students_trans.Attachments')}} : <span class="text-danger">*</span></label>
                                        <input type="file" accept="image/*" name="photo" >
                                    </div>
                                </div>
                                <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('teacher_trans.Submit')}}</button><br><br>
                                <button class="btn btn-warning btn-sm nextBtn btn-lg pull-right"  onclick="goToTeacher()">{{trans('Parent_trans.Back')}}</button>

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
    <script>
        function goToTeacher() {
            window.location.href = "{{ route('teachers.index') }}";
        }
    </script>
@endsection