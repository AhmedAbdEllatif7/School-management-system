@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.list_Graduate')}}
        @stop
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.list_Graduate')}} <i class="fas fa-user-graduate"></i>
    @stop
    <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row">
        
            @if(session('restore_student'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('restore_student') }}
                </div>
            @endif


            @if(session('delete_Selected'))
                <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ session('delete_Selected') }}
                </div>
            @endif
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="modal-effect btn btn-sm btn-danger" id="btn_delete_selected">
                                        <i class="fas fa-trash"></i>&nbsp;&nbsp;&nbsp;{{ trans('main_trans.delete_selected') }}
                                    </button>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="button" class="modal-effect btn btn-sm btn-warning" id="btn_restore_selected">
                                        <i class="fas fa-exchange-alt"></i>&nbsp;&nbsp;&nbsp;{{ trans('students_trans.restore_from_graduation') }}
                                    </button>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                                data-page-length="50"
                                                style="text-align: center">
                                            <thead>
                                                <tr class="alert-success">
                                                    <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /> </th>
                                                    <th>#</th>
                                                    <th>{{trans('Students_trans.name')}}</th>
                                                    <th>{{trans('Students_trans.email')}}</th>
                                                    <th>{{trans('Students_trans.gender')}}</th>
                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                    <th>{{trans('Students_trans.section')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students as $student)
                                                    <tr>
                                                    <td><input type="checkbox"  value="{{$student->id}}" class="box1" ></td>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->gender->name}}</td>
                                                    <td>{{$student->grade->name}}</td>
                                                    <td>{{$student->classroom->name}}</td>
                                                    <td>{{$student->section->name}}</td>
                                                    </tr>
                                                @include('dashboards.admin.graduation.restoreSelected')
                                                @include('dashboards.admin.graduation.deleteSelected')
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
        </div>
        </div>
        </div>
        <!-- row closed -->
    @endsection
        @section('js')
            <script>
                function CheckAll(className, elem) {
                    var elements = document.getElementsByClassName(className);
                    var l = elements.length;

                    if (elem.checked) {
                        for (var i = 0; i < l; i++) {
                            elements[i].checked = true;
                        }
                    } else {
                        for (var i = 0; i < l; i++) {
                            elements[i].checked = false;
                        }
                    }
                }
            </script>


        {{-- delete all selected --}}
        <script type="text/javascript">
            $(function() {
                $("#btn_delete_selected").click(function() {
                    var selected = new Array();
                    $(".box1:checked").each(function() {
                        selected.push(this.value);
                    });

                    if (selected.length > 0) {
                        $('#delete_selected_id').val(selected);
                        $('#delete_selected').modal('show');
                    } else {
                        // If no checkboxes are checked, show a message or handle accordingly
                        // For example:
                        alert('Please select at least one item to delete.');
                    }
                });
            });
        </script>


        {{-- restore all selected --}}
        <script type="text/javascript">
            $(function() {
                $("#btn_restore_selected").click(function() {
                    var selected = new Array();
                    $(".box1:checked").each(function() {
                        selected.push(this.value);
                    });

                    if (selected.length > 0) {
                        $('#restore_selected_id').val(selected);
                        $('#restore_selected').modal('show');
                    } else {
                        // If no checkboxes are checked, show a message or handle accordingly
                        // For example:
                        alert('Please select at least one item to restore.');
                    }
                });
            });
        </script>
    @endsection
