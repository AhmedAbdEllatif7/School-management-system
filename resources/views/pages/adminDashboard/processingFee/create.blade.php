@extends('layouts.master')
    @section('css')
    @section('title')
        {{ trans('students_trans.exclude_fee') }}
    @stop
    @section('PageTitle')
        {{ trans('students_trans.exclude_fee') }}
    @stop
    @endsection
    @section('content')
        {{ trans('students_trans.exclude_fee') }} : &nbsp;<span style="color: red">{{$student->name}}</span>

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

                        <form method="post"  action="{{route('processing-fees.store')}}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('students_trans.Amount') }} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="amount" type="number" required>
                                        <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('students_trans.student_balance') }} : </label>
                                        <input class="form-control" name="final_balance" value="{{ number_format(($student->student_account)->sum('Debit') - ($student->student_account)->sum('credit'), 2) }}" type="text" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('students_trans.description') }} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('students_trans.submit')}}</button>
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

    @endsection
