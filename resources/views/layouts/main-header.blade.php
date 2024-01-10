        <!--=================================
 header start--><!-- ... Other head elements ... -->


        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img src="assets/images/logo-dark.png" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-icon-dark.png"
                        alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>

            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <div class="btn-group mb-1">
                    <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (App::getLocale() == 'ar')
                            {{ LaravelLocalization::getCurrentLocaleName() }}
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



                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>


                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{URL::asset('assets/images/WhatsApp Image 2023-01-15 at 13.08.28.jpg')}}" alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{auth()->user()->name}}</h5>
                                    <span>{{auth()->user()->email}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        @if(auth()->guard('web')->check())
                        <a class="dropdown-item" href="{{route('settings.index')}}"><i class="text-info ti-settings">
                                </i>{{trans('main_trans.Setting')}}
                        </a>
                        @endif

                        @if(auth()->guard('student')->check())
                            <a href="{{route('student_profile.index')}}" class="dropdown-item">
                            <i class="fas fa-id-card-alt" style="color: #0d95e8;font-size: 15px"></i>
                                {{trans('main_trans.profile')}}</a>

                        @elseif(auth()->guard('teacher')->check())
                            <a href="{{route('teacher.profile.index')}}" class="dropdown-item">
                                <i class="fas fa-id-card-alt" style="color: #0d95e8;font-size: 15px"></i>
                                {{trans('main_trans.profile')}}</a>

                        @elseif(auth()->guard('parent')->check())
                            <a href="{{route('parent.profile')}}" class="dropdown-item">
                                <i class="fas fa-id-card-alt" style="color: #0d95e8;font-size: 15px"></i>
                                {{trans('main_trans.profile')}}</a>


                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                @if(auth('student')->check())
                    <form method="GET" action="{{ route('logout','student') }}">
                        @elseif(auth('teacher')->check())
                        <form method="GET" action="{{ route('logout','teacher') }}">
                            @elseif(auth('parent')->check())
                                <form method="GET" action="{{ route('logout','parent') }}">
                                    @else
                                        <form method="GET" action="{{ route('logout','web') }}">
                                            @endif

                                            @csrf
                                            <a class="dropdown-item" href="#"
                                               onclick="event.preventDefault();this.closest('form').submit();"><i class="fa fa-sign-out" style="color: #0d95e8;font-size: 20px"></i>
                                                {{trans('main_trans.logout')}}</a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </nav>

        <!--=================================
 header End-->
