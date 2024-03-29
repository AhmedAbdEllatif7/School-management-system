@extends('layouts.master')
    @section('css')
        @section('title')
            {{ trans('Students_trans.attendance') }}
        @stop
        @section('PageTitle')
            {{ trans('Sections_trans.title_page') }}:{{ trans('Students_trans.attendance') }}
        @stop
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->    
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="accordion gray plus-icon round">
                                @foreach ($grades as $grade)
                                    <div class="acd-group">
                                        <a href="#" class="acd-heading">{{ $grade->name }}</a>
                                        <div class="acd-des">
                                            <div class="row">
                                                <div class="col-xl-12 mb-30">
                                                    <div class="card card-statistics h-100">
                                                        <div class="card-body">
                                                            <div class="d-block d-md-flex justify-content-between">
                                                                <div class="d-block">
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive mt-15">
                                                                <table class="table center-aligned-table mb-0">
                                                                    <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>{{ trans('Sections_trans.Name_Section') }}
                                                                        </th>
                                                                        <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                        <th>{{ trans('Sections_trans.Status') }}</th>
                                                                        <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $i = 0; ?>
                                                                    @foreach ($grade->sections as $section)
                                                                        <tr>
                                                                            <?php $i++; ?>
                                                                            <td>{{ $i }}</td>
                                                                            <td>{{ $section->name }}</td>
                                                                            <td>{{ $section->classes->name }}</td>
                                                                            <td>
                                                                                <label class="badge badge-{{$section->status == 1 ? 'success':'danger'}}">{{$section->status == 1 ?  trans('Students_trans.active') :trans('Students_trans.inactive')}}</label>
                                                                            </td>

                                                                            <td>
                                                                                <a href="{{route('attendance.show', $section->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true">{{ trans('Students_trans.student_list') }}
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
