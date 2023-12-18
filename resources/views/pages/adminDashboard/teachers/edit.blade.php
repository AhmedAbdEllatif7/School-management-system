@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('teacher_trans.Edit_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('teacher_trans.Edit_Teacher') }}
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
                            <form action="{{route('teachers.update' , $teacher->id)}}" method="POST">
                                @method('PUT')
                            @csrf
                            <input name="id" value="{{$teacher->id}}" type="hidden">
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Email')}}</label>
                                    <input type="email" name="email" value="{{$teacher->email}}" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Password')}}</label>
                                    <input type="password" name="password" value="{{$teacher->password}}" class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Name_ar')}}</label>
                                    <input type="text" name="nameAr" value="{{ $teacher->getTranslation('name', 'ar') }}" class="form-control">
                                    @error('nameAr')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Name_en')}}</label>
                                    <input type="text" name="nameEn" value="{{ $teacher->getTranslation('name', 'en') }}" class="form-control">
                                    @error('nameEn')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('teacher_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specializationId">
                                        <option value="{{$teacher->specialization_id}}">{{$teacher->specializations->name}}</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('specializationId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('teacher_trans.Gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="genderId">
                                        <option value="{{$teacher->gender_id}}">{{$teacher->genders->name}}</option>
                                        @foreach($genders as $gender)
                                            <option value="{{$gender->id}}">{{$gender->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('genderId')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('teacher_trans.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action"  value="{{$teacher->joining_date}}" name="joiningDate" data-date-format="yyyy-mm-dd"  required>
                                    </div>
                                    @error('joiningDate')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('teacher_trans.Address')}}</label>
                                <textarea class="form-control" name="address"
                                        id="exampleFormControlTextarea1" rows="4">{{$teacher->address}}</textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <br>

                            @if($teacher->images->isNotEmpty() && $teacher->images->first()->filename !== null)
                                @foreach($teacher->images as $image)
                                    <p>{{$image->filename}}</p>
                                    <img src="{{ asset('attachments/teachers/' . $teacher->email . '/' . $image->filename) }}" alt="Teacher Image" 
                                    style="width:150px; height:100opx">
                                @endforeach
                            @else
                                <p>No image available for this teacher.</p>
                            @endif

                        

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('teacher_trans.update')}}</button><br><br>

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

@endsection