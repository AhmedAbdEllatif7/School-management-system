


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('assets2/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('assets2/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::asset('assets2/css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('assets2/css/style.css')}}">

    <title>{{$type}} : Login</title>
</head>
<body>



<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <img src="{{URL::asset('assets2/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">

            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            @if($type=='student')
                                <img src="{{URL::asset('assets/images/student-removebg-preview.png')}}" alt="Image" class="img-fluid" style="max-width: 300px; max-height: 300px;">
                            @elseif($type=='parent')
                                <img src="{{URL::asset('assets/images/parent-removebg-preview.png')}}" alt="Image" class="img-fluid" style="max-width: 200px; max-height: 200px;">
                            @elseif($type=='teacher')
                                <img src="{{URL::asset('assets/images/teacher-removebg-preview.png')}}" alt="Image" class="img-fluid" style="max-width: 200px; max-height: 200px;">
                            @else
                                <img src="{{URL::asset('assets/images/admin-removebg-preview.png')}}" alt="Image" class="img-fluid" style="max-width: 200px; max-height: 200px;">
                            @endif
                                <br><br>
                            <h3><span style="color:red">{{$type}}</span> : Sign In</h3>
                            <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                        </div>
                        @if (\Session::has('message'))
                            <div class="alert alert-danger">
                                <li>{!! \Session::get('message') !!}</li>
                            </div>
                        @endif
                        <form action="{{route('login')}}" method="POST" autocomplete="on" autofocus>
                            @csrf
                            <div class="section-field mb-20">
                                <label class="mb-10" for="name">البريد الإلكتروني*</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <input type="hidden" value="{{$type}}" name="type">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="section-field mb-20">
                                <label class="mb-10" for="Password">كلمة المرور* </label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                       id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">{{trans('main_trans.show_password')}}</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                @enderror
                            </div>
                            <br>

                            <input type="submit" value="Log In" class="btn btn-block btn-primary">
                            <br>


                            <div class="section-field">
                                <div class="remember-checkbox mb-30">
                                    <a href="#" class="float-right">هل نسيت كلمة المرور؟</a>
                                </div>
                            </div>
<br>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="{{URL::asset('assets2/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{URL::asset('assets2/js/popper.min.js')}}"></script>
<script src="{{URL::asset('assets2/js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets2/js/main.js')}}"></script>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>

{{--<!DOCTYPE html>--}}
{{--<html lang="en" dir="rtl">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="keywords" content="HTML5 Template" />--}}
{{--    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />--}}
{{--    <meta name="author" content="potenzaglobalsolutions.com" />--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />--}}
{{--    <title>برنامج مورا سوفت لادارة المدارس</title>--}}

{{--    <!-- Favicon -->--}}
{{--    <link rel="shortcut icon" href="images/favicon.ico" />--}}

{{--    <!-- Font -->--}}
{{--    <link rel="stylesheet"--}}
{{--          href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">--}}

{{--    <!-- css -->--}}
{{--    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">--}}

{{--</head>--}}

{{--<body>--}}

{{--<div class="wrapper">--}}
{{--    <!--=================================--}}
{{--preloader -->--}}

{{--    <div id="pre-loader">--}}
{{--        <img src="{{URL::asset('assets/images/pre-loader/loader-01.svg')}}" alt="">--}}
{{--    </div>--}}

{{--    <!--=================================--}}
{{--preloader -->--}}

{{--    <!--=================================--}}
{{--login-->--}}

{{--    <section class="height-100vh d-flex align-items-center page-section-ptb login"--}}
{{--             style="background-image: url('{{ asset('assets/images/sativa.png')}}');">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-center no-gutters vertical-align">--}}
{{--                <div class="col-lg-4 col-md-6 login-fancy-bg bg"--}}
{{--                     style="background-image: url('{{ asset('assets/images/login-inner-bg.jpg')}}');">--}}
{{--                    <div class="login-fancy">--}}
{{--                        <h2 class="text-white mb-20">Hello world!</h2>--}}
{{--                        <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose--}}
{{--                            responsive template along with powerful features.</p>--}}
{{--                        <ul class="list-unstyled  pos-bot pb-30">--}}
{{--                            <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>--}}
{{--                            <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-4 col-md-6 bg-white">--}}
{{--                    <div class="login-fancy pb-40 clearfix">--}}
{{--                        @if($type == 'student')--}}
{{--                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">تسجيل دخول طالب</h3>--}}
{{--                        @elseif($type == 'parent')--}}
{{--                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">تسجيل دخول ولي امر</h3>--}}
{{--                        @elseif($type == 'teacher')--}}
{{--                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">تسجيل دخول معلم</h3>--}}
{{--                        @else--}}
{{--                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">تسجيل دخول ادمن</h3>--}}
{{--                        @endif--}}
{{--                        <form method="POST" action="{{route('login')}}">--}}
{{--                            @csrf--}}

{{--                            <div class="section-field mb-20">--}}
{{--                                <label class="mb-10" for="name">البريدالالكتروني*</label>--}}
{{--                                <input id="email" type="email"--}}
{{--                                       class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--                                       value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                                <input type="hidden" value="{{$type}}" name="type">--}}
{{--                                @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                @enderror--}}

{{--                            </div>--}}

{{--                            <div class="section-field mb-20">--}}
{{--                                <label class="mb-10" for="Password">كلمة المرور * </label>--}}
{{--                                <input id="password" type="password"--}}
{{--                                       class="form-control @error('password') is-invalid @enderror" name="password"--}}
{{--                                       required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                @enderror--}}

{{--                            </div>--}}
{{--                            <div class="section-field">--}}
{{--                                <div class="remember-checkbox mb-30">--}}
{{--                                    <input type="checkbox" class="form-control" name="two" id="two" />--}}
{{--                                    <label for="two"> تذكرني</label>--}}
{{--                                    <a href="#" class="float-right">هل نسيت كلمةالمرور ؟</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <button class="button"><span>دخول</span><i class="fa fa-check"></i></button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!--=================================--}}
{{--login-->--}}

{{--</div>--}}
{{--<!-- jquery -->--}}
{{--<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>--}}
{{--<!-- plugins-jquery -->--}}
{{--<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>--}}
{{--<!-- plugin_path -->--}}
{{--<script>--}}
{{--    var plugin_path = 'js/';--}}

{{--</script>--}}

{{--<!-- chart -->--}}
{{--<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>--}}
{{--<!-- calendar -->--}}
{{--<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>--}}
{{--<!-- charts sparkline -->--}}
{{--<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>--}}
{{--<!-- charts morris -->--}}
{{--<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>--}}
{{--<!-- datepicker -->--}}
{{--<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>--}}
{{--<!-- sweetalert2 -->--}}
{{--<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>--}}
{{--<!-- toastr -->--}}
{{--@yield('js')--}}
{{--<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>--}}
{{--<!-- validation -->--}}
{{--<script src="{{ URL::asset('assets/js/validation.js') }}"></script>--}}
{{--<!-- lobilist -->--}}
{{--<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>--}}
{{--<!-- custom -->--}}
{{--<script src="{{ URL::asset('assets/js/custom.js') }}"></script>--}}

{{--</body>--}}

{{--</html>--}}
