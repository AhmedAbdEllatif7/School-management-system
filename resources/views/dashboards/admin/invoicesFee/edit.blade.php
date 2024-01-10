@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('students_trans.edit_fees')}}
        @stop
        @section('PageTitle')
            {{trans('students_trans.edit_fees')}}
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

                        <form action="{{route('invoices-fees.update', 'error')}}" method="POST" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputEmail4">{{trans('students_trans.student_name')}}</label>
                                    <input type="text" value="{{$invoiceFee->student->name}}" readonly class="form-control" required>
                                    <input type="hidden" value="{{$invoiceFee->id}}" name="id" class="form-control">
                                </div>


                                <div class="form-group col">
                                    <label for="inputEmail4">{{trans('students_trans.Amount')}}</label>
                                    <input type="number" value="{{$invoiceFee->amount}}" name="amount" class="form-control" required>
                                </div>

                            </div>


                            <div class="form-row">

                                <div class="form-group col">
                                    <label for="inputZip">{{trans('students_trans.fee_type')}}</label>
                                    <select class="custom-select mr-sm-2" name="fee_id" required>
                                        @foreach($fees as $fee)
                                            <option value="{{$fee->id}}" {{$fee->id == $invoiceFee->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="inputAddress">{{trans('students_trans.Notes')}}</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$invoiceFee->description}}</textarea>
                            </div>
                            <br>

                            <button type="submit" class="btn btn-primary">{{trans('students_trans.submit')}}</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')
        
    @endsection
