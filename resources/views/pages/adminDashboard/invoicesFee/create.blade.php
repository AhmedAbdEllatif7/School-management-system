@extends('layouts.master')
    @section('css')
    @section('title')
        {{ trans('students_trans.add_invoice_fee') }}
    @stop
    @section('PageTitle')
    {{ trans('students_trans.add_invoice_fee') }} / {{$student->name}}
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

                            <form class=" row mb-30" action="{{route('invoices-fees.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="repeater">
                                        <div data-repeater-list="listOfFees">
                                            <div data-repeater-item>
                                                <div class="row">

                                                    <div class="col">
                                                        <label for="Name" class="mr-sm-2">{{ trans('students_trans.student_name') }}</label>
                                                        <select class="fancyselect" name="student_id" required>
                                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                                    <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{ trans('students_trans.fee_type') }}</label>
                                                        <div class="box">
                                                            <select class="fancyselect" name="fee_id" required>
                                                                <option value="">{{ trans('students_trans.select_from_menu') }}</option>
                                                                @foreach($fees as $fee)
                                                                    <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{ trans('students_trans.amount') }}</label>
                                                        <div class="box">
                                                            <select class="fancyselect" name="amount" required>
                                                                <option value="">{{ trans('students_trans.select_from_menu') }}</option>
                                                                @foreach($fees as $fee)
                                                                    <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <label for="description" class="mr-sm-2">{{ trans('students_trans.description') }}</label>
                                                        <div class="box">
                                                            <input type="text" class="form-control" name="description" required>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <label for="Name_en" class="mr-sm-2">{{ trans('classes_trans.Processes') }}:</label>
                                                        <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('classes_trans.delete_row') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-20">
                                            <div class="col-12">
                                                <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_row') }}"/>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary">{{ trans('students_trans.confirm_data') }}</button>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')


    @endsection
