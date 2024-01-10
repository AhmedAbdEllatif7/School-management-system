<!DOCTYPE html>
<html lang="en">
@section('title')
    {{trans('main_trans.Student_Dashboard')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<body style="font-family: 'Cairo', sans-serif">

<div class="wrapper" style="font-family: 'Cairo', sans-serif">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
    </div>

    <!--=================================
preloader -->

    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title" >
            <div class="row">
                <div class="col-sm-6" >
                    <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">مرحبا بك : {{auth()->user()->name}}</h4>
                </div><br><br>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
            <!-- widgets -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-30"> <!-- Adjust the column classes here -->
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="clearfix">
                                    <div class="float-left">

                                    </div>
                                    <div class="float-right text-right">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <h4 style="font-family: Cairo; color:#00B5AD; text-align: center; display: inline-block; max-width: 100%; white-space: nowrap;">{{ trans('main_trans.subject_information') }}</h4>

                                            <th>#</th>
                                            <th>{{ trans('Students_trans.subject_name_english') }}</th>
                                            <th>{{ trans('Students_trans.educational_stage') }}</th>
                                            <th>{{ trans('Students_trans.class') }}</th>
                                            <th>{{ trans('Students_trans.teacher_name') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$subject->name}}</td>
                                                <td>{{$subject->grade->name}}</td>
                                                <td>{{$subject->classroom->name}}</td>
                                                <td>{{$subject->teacher->name}}</td>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="calendar-main mb-30">
                <livewire:calendar-student />
            </div>
        <!--=================================
wrapper -->

        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>
<!--=================================
footer -->

@include('layouts.footer-scripts')
@livewireScripts
@stack('scripts')
</body>

</html>
