<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('assetsForLoginForms/fonts/icomoon/style.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assetsForLoginForms/css/owl.carousel.min.css')}}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{URL::asset('assetsForLoginForms/css/bootstrap.min.css')}}">
        <!-- Style -->
        <link rel="stylesheet" href="{{URL::asset('assetsForLoginForms/css/style.css')}}">
        <title>{{trans('main_trans.'.$type)}} : {{trans('main_trans.sign_in')}}</title>
    </head>
    <body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{URL::asset('assetsForLoginForms/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
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
                                    <h3><span style="color:red">{{ trans('main_trans.' . $type) }}</span> : {{ trans('main_trans.sign_in') }}</h3>
                                    <p class="mb-4">{{trans('main_trans.welcome_back')}}</p>
                            </div>
                            @if (\Session::has('message'))
                                <div class="alert alert-danger">
                                    <li>{!! \Session::get('message') !!}</li>
                                </div>
                            @endif
                            <form action="{{route('login')}}" method="POST" autocomplete="on" autofocus>
                                @csrf
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="name"> {{trans('main_trans.email')}}*</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <input type="hidden" value="{{$type}}" name="type">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br>
                                <div class="section-field mb-20">
                                    <label class="mb-10" for="Password">{{trans('main_trans.password')}}* </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="form-check-input" onclick="myFunction()"
                                        id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">{{trans('main_trans.show_password')}}</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <br>
                                <input type="submit" value="{{trans('main_trans.sign_in')}}" class="btn btn-block btn-primary">
                                <br>
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
    <script src="{{URL::asset('assetsForLoginForms/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::asset('assetsForLoginForms/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('assetsForLoginForms/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assetsForLoginForms/js/main.js')}}"></script>
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
