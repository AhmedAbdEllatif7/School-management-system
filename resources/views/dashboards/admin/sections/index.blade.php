@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('Sections_trans.add_section') }}</a>
                </div>

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


                @if(session('update_section'))
                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('update_section') }}
                    </div>
                @endif


                @if(session('sections_name_existed'))
                    <div class="alert alert-danger text-center" style="width: 40%; margin: auto;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('sections_name_existed') }}
                    </div>
                @endif



                @if(session('delete_section'))
                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('delete_section') }}
                    </div>
                @endif

                @if(session('add'))
                    <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('add') }}
                    </div>
                @endif


                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($gradesWithItsSections as $grade)
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
                                                                @foreach ($grade->sections as $listOfSections)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $listOfSections->name }}</td>
                                                                        <td>{{ $listOfSections->classes->name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($listOfSections->status == 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ trans('Sections_trans.Status_Section_No') }}</label>
                                                                            @endif

                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                            class="btn btn-outline-info btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#edit{{ $listOfSections->id }}">{{ trans('Sections_trans.Edit') }}</a>
                                                                            <a href="#"
                                                                            class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="#delete{{ $listOfSections->id }}">{{ trans('Sections_trans.Delete') }}</a>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- edit_modal_Grade -->
                                                                    <div class="modal fade" id="edit{{ $listOfSections->id }}" tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('grade_trans.edit_Grade') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <!-- edit_form -->
                                                                                    <form action="{{ route('sections.update', 'test') }}" method="post">
                                                                                        {{ method_field('patch') }}
                                                                                        @csrf
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <label for="Name"
                                                                                                    class="mr-sm-2">{{ trans('Sections_trans.Section_name_ar') }}
                                                                                                    :</label>
                                                                                                <input type="text"
                                                                                                    name="name_ar"
                                                                                                    class="form-control"
                                                                                                    value="{{ $listOfSections->getTranslation('name', 'ar') }}">
                                                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                                                    value="">
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <label for="Name_en"
                                                                                                    class="mr-sm-2">{{ trans('Sections_trans.Section_name_en') }}
                                                                                                    :</label>
                                                                                                <input type="text"
                                                                                                    name="name_en"
                                                                                                    class="form-control"
                                                                                                    value="{{ $listOfSections->getTranslation('name', 'en') }}">
                                                                                                <input id="id"
                                                                                                    type="hidden"
                                                                                                    name="id"
                                                                                                    class="form-control"
                                                                                                    value="{{ $listOfSections->id }}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                                                                                <select name="grade_id" class="custom-select" onclick="console.log($(this).val())">
                                                                                                    @foreach ($AllGrades as $AllGrade)
                                                                                                        <option value="{{ $AllGrade->id }}" {{ $grade->id == $AllGrade->id ? 'selected' : '' }}>
                                                                                                            {{ $AllGrade->name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                                
                                                                                        </div>
                                                                                        <br>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                                                                            <select name="class_id"
                                                                                                    class="custom-select">
                                                                                                <option
                                                                                                    value="{{ $listOfSections->classes->id }}">
                                                                                                    {{ $listOfSections->classes->name }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                class="control-label">{{ trans('Sections_trans.Status') }}</label>
                                                                                                <select name="status">
                                                                                                    @if($listOfSections->status == 0)
                                                                                                        <option value="0" selected>{{ trans('Sections_trans.Not active') }}</option>
                                                                                                        <option value="1">{{ trans('Sections_trans.Active') }}</option>
                                                                                                    @else
                                                                                                        <option value="1" selected>{{ trans('Sections_trans.Active') }}</option>
                                                                                                        <option value="0">{{ trans('Sections_trans.Not active') }}</option>
                                                                                                    @endif
                                                                                                </select>
                                                                                                
                                                                                                
                                                                                        </div>

                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                                                                            <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">                                                                                                
                                                                                                @foreach($teachers as $teacher)
                                                                                                    <option value="{{ $teacher->id }}" {{ in_array($teacher->id, $listOfSections->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                                                                        {{ $teacher->name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br><br>

                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>




                                                                    <!-- delete_modal_Class -->
                                                                    <div class="modal fade"
                                                                        id="delete{{ $listOfSections->id }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('Sections_trans.delete_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('sections.destroy', 'test') }}"
                                                                                        method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('Sections_trans.Warning_Section') }}
                                                                                        <input id="id" type="hidden"
                                                                                            name="id"
                                                                                            class="form-control"
                                                                                            value="{{ $listOfSections->id }}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>




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

                    <!--اضافة قسم جديد -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('Sections_trans.add_section') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('sections.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="name_ar" class="form-control"
                                                    placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="name_en" class="form-control"
                                                        placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                                            </div>

                                        </div>
                                        <br>


                                        <div class="col">
                                            <label for="inputName"
                                                    class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                            <select name="grade_id" class="custom-select"
                                                    onchange="console.log($(this).val())">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('Sections_trans.Select_Grade') }}
                                                </option>
                                                @foreach ($AllGrades as $AllGrade)
                                                    <option value="{{ $AllGrade->id }}"> {{ $AllGrade->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                    class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                            <select name="class_id" class="custom-select">

                                            </select>
                                        </div><br>

                                        <div class="col">
                                            <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                @foreach($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="inputName"
                                                class="control-label">{{ trans('Sections_trans.Status') }}</label>
                                            <select name = 'status' >
                                                <option value="1">{{trans('Sections_trans.Active')}}</option>
                                                <option value="0">{{trans('Sections_trans.Not active')}}</option>
                                            </select>
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                                </div>
                                </form>
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
                $(document).ready(function () {
                    $('select[name="grade_id"]').on('change', function () {
                        var grade_id = $(this).val();
                        if (grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>

@endsection
