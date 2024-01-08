@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.books_list')}}
        @stop
        @section('PageTitle')
            {{trans('main_trans.books_list')}}
        @stop
    @endsection
    @section('content')
        <!-- row -->
        @if(session('edit_done'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('edit_done') }}
            </div>
        @endif

        @if(session('error_file_found'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('error_file_found') }}
            </div>
        @endif


        @if(session('delete_done'))
            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('delete_done') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <a href="{{route('libraries.create')}}" class="btn btn-success btn-sm" role="button"
                                    aria-pressed="true">{{trans('main_trans.add_new_book')}}</a><br><br>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                            data-page-length="50"
                                            style="text-align: center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('main_trans.book_name')}}</th>
                                                <th>{{trans('main_trans.grade')}}</th>
                                                <th>{{trans('main_trans.classroom')}}</th>
                                                <th>{{trans('main_trans.section')}}</th>
                                                <th>{{trans('main_trans.processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $book)
                                                <tr>
                                                    <td>{{ $loop->iteration}}</td>
                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->grade->name}}</td>
                                                    <td>{{$book->classroom->name}}</td>
                                                    <td>{{$book->section->name}}</td>
                                                    <td>
                                                        <a href="{{route('download.book',$book->file_name )}}" title="{{trans('main_trans.download_book')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                                        <a href="{{route('view.book',$book->file_name )}}" title="{{trans('main_trans.view_book')}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye" style="color: darkblue; font-size: 15px;"></i></a>
                                                        <a href="{{route('libraries.edit' ,$book->id )}}" title="{{trans('main_trans.edit_book')}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}" title="{{trans('main_trans.delete_book')}}"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>

                                            @include('pages.adminDashboard.library.destroy')
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
