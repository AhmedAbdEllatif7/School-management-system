<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
        <meta name="author" content="potenzaglobalsolutions.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>{{trans('main_trans.school_system')}}</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico" />
        <!-- Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
        <!-- css -->
        <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
           
            <section class="height-100vh d-flex align-items-center page-section-ptb login"
                    style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
                    
                <div class="container">
                    
                    <div class="row justify-content-center no-gutters vertical-align">
                        <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                            <div class="login-fancy pb-40 clearfix">
                                <div style="text-align: center;">
                                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if (App::getLocale() == 'ar')
                                            العربية
                                            <img src="{{ URL::asset('assets/images/flags/EG.png') }}" alt="">
                                        @else
                                            {{ LaravelLocalization::getCurrentLocaleName() }}
                                            <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
                                        @endif
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <br>
                                <div style="text-align: center;">
                                    <h3 style="font-family: 'Cairo', sans-serif" class="mb-30">{{ trans('main_trans.select_login_type') }}</h3>
                                </div>
                                <div class="form-inline">
                                    <a class="btn btn-default col-lg-3" title="{{ trans('main_trans.student') }}" href="{{route('login.show','student')}}">
                                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/student.png')}}">
                                    </a>
                                    <a class="btn btn-default col-lg-3" title="{{ trans('main_trans.parent') }}" href="{{route('login.show','parent')}}">
                                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/parent.png')}}">
                                    </a>
                                    <a class="btn btn-default col-lg-3" title="{{ trans('main_trans.teacher') }}" href="{{route('login.show','teacher')}}">
                                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/teacher.png')}}">
                                    </a>
                                    <a class="btn btn-default col-lg-3" title="{{ trans('main_trans.admin') }}" href="{{route('login.show','admin')}}">
                                        <img alt="user-img" width="100px;" src="{{URL::asset('assets/images/admin.png')}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- jquery -->
        <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
        <!-- plugins-jquery -->
        <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
        <!-- plugin_path -->
    </body>
</html>
