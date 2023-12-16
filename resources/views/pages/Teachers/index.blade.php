@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.List_Teachers')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.List_Teachers')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">


        @if(session('update_teacher'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('update_teacher') }}
            </div>
        @endif

            @if(session('delete_teacher'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('delete_teacher') }}
            </div>
        @endif
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{ trans('teacher_trans.Add_Teacher') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('teacher_trans.Name_Teacher')}}</th>
                                            <th>{{trans('teacher_trans.Gender')}}</th>
                                            <th>{{trans('teacher_trans.Joining_Date')}}</th>
                                            <th>{{trans('teacher_trans.specialization')}}</th>
                                            <th>{{trans('teacher_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($teachers as $teacher)
                                            <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->genders->name}}</td>
                                            <td>{{$teacher->joining_date}}</td>
                                            <td>{{$teacher->specializations->name}}</td>
                                                <td>
                                                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_Teacher" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="{{ route('teachers.show', $teacher->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true" title="{{ trans('Students_trans.View') }}"><i class="far fa-eye"></i></a>

                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('teachers.destroy' , $teacher->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('teacher_trans.Delete_Teacher') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('teacher_trans.Are you sure you want to delete this teacher ?') }}</p>
                                                            <input type="hidden" name="id"  value="{{$teacher->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('teacher_trans.delete') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                </div>
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
