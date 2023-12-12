@extends('layouts.master')
@section('css')
    @section('title')
        {{ trans('classes_trans.title_page') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('classes_trans.title_page') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
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


                        @if(session('add'))
                            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('add') }}
                            </div>
                        @endif


                        @if(session('delete'))
                            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('delete') }}
                            </div>
                        @endif


                        @if(session('delete_selected'))
                            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('delete_selected') }}
                            </div>
                        @endif


                    @if(session('update'))
                            <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('update') }}
                            </div>
                        @endif


                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('classes_trans.add_class') }}
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger" id="btn_delete_all">
                        {{ trans('classes_trans.delete_checkbox') }}
                    </button>


                    <br><br>      
                    <div class="container mt-1">
                            <div class="row justify-content-start">
                                <div class="col-md-3">
                                    <form action="{{route('filter.classes')}}" method="GET" class="border rounded p-2">
                                        {{ csrf_field() }}
                                        <h5 class="mb-3 text-center">Search By Grade</h5>
                                        <div class="form-group">
                                            <label for="grade_id">Select Grade:</label>
                                            <select class="form-control form-control-sm" name="grade_id" required onchange="this.form.submit()">
                                                <option value="" selected disabled>-- Select Grade --</option>
                                                <option value="1" > All </option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="text-center">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                            <tr>
                                <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th>#</th>
                                <th>{{ trans('classes_trans.Name_class') }}</th>
                                <th>{{ trans('classes_trans.Name_Grade') }}</th>
                                <th>{{ trans('classes_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (isset($search))

                                    <?php $listClasses = $search; ?>
                            @else

                                    <?php $listClasses = $classrooms; ?>
                            @endif

                            <?php $i = 0; ?>

                            @foreach ($listClasses as $classrooms)
                                <tr>
                                        <?php $i++; ?>
                                    <td><input type="checkbox"  value="{{ $classrooms->id }}" class="box1" ></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $classrooms->name }}</td>
                                    <td>{{ $classrooms->grades->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classrooms->id }}"
                                                title="{{ trans('grade_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classrooms->id }}"
                                                title="{{ trans('grade_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <!-- edit_modal_classroom -->
                                <div class="modal fade" id="edit{{ $classrooms->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('classes_trans.edit_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- edit_form -->
                                                <form action="{{route('classrooms.update','test')}}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                    class="mr-sm-2">{{ trans('classes_trans.Name_class_in_arabic') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar"
                                                                    class="form-control"
                                                                    value="{{ $classrooms->getTranslation('name', 'ar') }}"
                                                                    required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                    value="{{ $classrooms->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('classes_trans.Name_class_in_english') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                    value="{{ $classrooms->getTranslation('name', 'en') }}"
                                                                    name="name_en" >
                                                        </div>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('classes_trans.Name_Grade') }}
                                                            :</label>
                                                            <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="grade_id">
                                                                <option disabled value="">Select Grade</option>
                                                                @foreach ($grades as $grade)
                                                                    <option value="{{ $grade->id }}" {{ $grade->id == $classrooms->grades->id ? 'selected' : '' }}>
                                                                        {{ $grade->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>                                                         
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('classes_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- delete_modal_classroom -->
                                <div class="modal fade" id="delete{{$classrooms->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    {{ trans('classes_trans.delete_Classroom') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- delete<_form -->
                                                <form action="{{ route('classrooms.destroy' , 'test') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">{{ trans('grade_trans.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="name_ar" class="form-control"
                                                                value="{{$classrooms->getTranslation('name','ar')}}" readonly>
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">{{ trans('grade_trans.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control" name="name_en"
                                                                value="{{$classrooms->getTranslation('name','en')}}" readonly>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="id" name="id" value="{{$classrooms->id}}" >
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">{{ trans('grade_trans.Grade') }}
                                                            :</label>
                                                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                                                rows="3" readonly>{{$classrooms->grades->name}}</textarea>
                                                    </div>
                                                    <br><br>

                                                    <h3>{{ trans('grade_trans.Are you sure you want delete it ?') }}</h3>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                                        <button type="submit" class="btn btn-danger">{{ trans('classes_trans.delete_classroom') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('classes_trans.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{route('classrooms.store')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="listOfClasses">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ trans('classes_trans.Name_class') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="name_ar" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ trans('classes_trans.Name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="name_en" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ trans('classes_trans.Name_Grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="grade_id">
                                                            @foreach ($grades as $grade)
                                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ trans('classes_trans.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button" value="{{ trans('classes_trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('classes_trans.add_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('classes_trans.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>



    <!-- حذف مجموعة صفوف -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classes_trans.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('delete.selected.classrooms')}}" method="POST">
                    @method('DELETE')
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{ trans('classes_trans.Warning_class') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('classes_trans.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('classes_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    </div>



    <!-- row closed -->
@endsection
@section('js')


    <script type="text/javascript">
        $(function() {
            $("#btn_delete_all").click(function() {
                var selected = new Array();
                $("#datatable input[type=checkbox]:checked").each(function() {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_all').modal('show')
                    $('input[id="delete_all_id"]').val(selected);
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
