@extends('layouts.master')
    @section('css')
        @section('title')
            {{ trans('Students_trans.add_receipt') }}
        @stop
        @section('PageTitle')
            {{ trans('Students_trans.student_receipt') }} {{$student->name}}
        @stop
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

                            <form method="POST"  action="{{route('student-receipt.store')}}" autocomplete="off">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ trans('Students_trans.Amount') }} : <span class="text-danger">*</span></label>
                                            <input  class="form-control" name="debit" type="number" required>
                                            <input  type="hidden" name="student_id"  value="{{$student->id}}" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ trans('Students_trans.description') }} : <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')


    @endsection
