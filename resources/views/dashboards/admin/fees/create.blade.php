@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('Students_trans.add_new_fees')}}
        @endsection
        @section('PageTitle')
            {{trans('Students_trans.add_new_fees')}}
        @endsection
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row">
            @if(session('store_fees'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('store_fees') }}
                </div>
            @endif
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
                            <form method="POST" action="{{ route('fees.store') }}" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputEmail4">{{ trans('Students_trans.name_ar') }}</label>
                                        <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control" required>
                                        @error('title_ar')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputEmail4">{{ trans('Students_trans.name_en') }}</label>
                                        <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control" required>
                                        @error('title_en')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputEmail4">{{ trans('Students_trans.Amount') }}</label>
                                        <input type="number" value="{{ old('amount') }}" name="amount" class="form-control" required>
                                        @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
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

                                    <div class="form-group col">
                                        <label for="inputZip">{{ trans('Students_trans.Classroom') }}</label>
                                        <select class="custom-select mr-sm-2" name="classroom_id" required></select>
                                        @error('classroom_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col">
                                        <label for="inputZip">{{ trans('Students_trans.Academic Year') }}</label>
                                        <select class="custom-select mr-sm-2" name="year" required>
                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                            @php
                                                $current_year = date("Y")
                                            @endphp
                                            @for($year = $current_year; $year <= $current_year + 1; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                        @error('year')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col">
                                        <label for="inputZip">{{trans('Students_trans.Fees_type')}}</label>
                                        <select class="custom-select mr-sm-2" name="fee_type">
                                            <option value="1">{{trans('Students_trans.Study_fees')}}</option>
                                            <option value="2">{{trans('Students_trans.Study_bus')}}</option>
                                        </select>
                                        @error('fee_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress">{{ trans('Students_trans.Notes') }}</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>

                                <button type="submit" class="btn btn-primary">{{ trans('Students_trans.submit') }}</button>
                            </form>


                    </div>
                </div>
            </div>
        </div>

        <!-- row closed -->
    @endsection
    @section('js')
        @include('layouts.ajax')
    @endsection
