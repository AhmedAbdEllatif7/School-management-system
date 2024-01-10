@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.manage_promotion')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.manage_promotion')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
    
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                @if(session('retriveAll'))
                                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ session('retriveAll') }}
                                    </div>
                                @endif
                                @if(session('promotion_retreved'))
                                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ session('promotion_retreved') }}
                                    </div>
                                @endif

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    {{ trans('main_trans.revert_all') }}
                                </button>
                                &nbsp;

                                <button type="button" class="modal-effect btn btn-sm btn-warning" id="btn_revert_selected">
                                    <i class="text-success fas fa-exchange-alt"></i>&nbsp;&nbsp;&nbsp;{{trans('students_trans.revert_seletecd_promotion')}}
                                </a>
                                </button>
            
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50"
                                        style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th><input name="revertSelected" id="example-revert-selected" type="checkbox" onclick="CheckAll('box1', this)" /> </th>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ trans('main_trans.name') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_stage') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.olde_academic_year') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_grade') }}</th>
                                            <th class="alert-danger">{{ trans('main_trans.previous_section') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_stage') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_academic_year') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_grade') }}</th>
                                            <th class="alert-success">{{ trans('main_trans.current_section') }}</th>
                                            <th class="alert-success">{{trans('Students_trans.Processes')}}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td><input type="checkbox"  value="{{ $promotion->id }}" class="box1" ></td>
                                                <td>{{ $loop->index+1 }}</td>

                                                    @if (!$promotion->student)
                                                        <td>{{$promotion->student()->withTrashed()->first()->name}}</td>
                                                    @endif

                                                @if ($promotion->student)
                                                    <td>{{$promotion->student->name}}</td>
                                                @endif
                                                <td>{{$promotion->fromGrade->name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->fromClassroom->name}}</td>
                                                <td>{{$promotion->fromSection->name}}</td>
                                                <td>{{$promotion->toGrade->name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->toClassroom->name}}</td>
                                                <td>{{$promotion->toSection->name}}</td>
                                            </tr>
                                        @include('pages.adminDashboard.promotion.revertAll')
                                        @include('pages.adminDashboard.promotion.revertSelected')
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
<script type="text/javascript">
        $(function() {
            $("#btn_revert_selected").click(function() {
                var selected = new Array();
                $(".box1:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#revert_seleted_id').val(selected);
                    $('#revert_all_selected').modal('show');
                } else {
                    // If no checkboxes are checked, show a message or handle accordingly
                    // For example:
                    alert('Please select at least one item to force delete.');
                }
            });
        });
    </script>


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
@endsection
