<!DOCTYPE html>
<html lang="en">
@section('title')
    {{trans('main_trans.parent_dashboard')}}
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
        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>
        @include('layouts.main-header')

        @include('layouts.main-sidebar')
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-6" >
                        <h4 class="mb-0" style=" font-family: 'Cairo', sans-serif;">{{trans('main_trans.welcome')}} : {{auth()->user()->Name_Father}} </h4>
                    </div><br><br>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>

            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        @foreach($sons as $son)
                            <div class="col-md-8 col-lg-6 col-xl-4">
                                <a href="">
                                    <div class="card text-black">
                                        <img src="{{ URL::asset('assets/images/student-removebg-preview.png') }}" style="width: 55px; height: 55px;" />
                                        <div class="card-body">
                                            <div class="text-center">
                                                <h5 style="font-family: 'Cairo', sans-serif"
                                                    class="card-title">{{$son->name}}</h5>
                                                <p class="text-muted mb-4">{{trans('main_trans.information_student')}}</p>
                                            </div>
                                            <div>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{trans('main_trans.grade')}}</span><span>{{$son->grade->name}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{trans('main_trans.classroom')}}</span><span>{{$son->classroom->name}}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>{{trans('main_trans.section')}}</span><span>{{$son->section->name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @include('layouts.footer')
        </div>
    </div>
</div>
</div>
<!--=================================
footer -->

@include('layouts.footer-scripts')
</body>

</html>
