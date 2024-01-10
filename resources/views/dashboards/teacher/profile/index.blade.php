    @extends('layouts.master')
    @section('css')
    @section('title')
        {{trans('main_trans.profile')}}
    @stop
    @endsection
    @section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{trans('main_trans.profile')}}
    @stop
    <!-- breadcrumb -->
    @endsection
    @section('content')
    <!-- row -->

    @if(session('edit_done'))
        <div class="alert alert-success text-center" style="width: 40%; margin: auto;">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session('edit_done') }}
        </div>
    @endif

    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{URL::asset('assets/images/teacher.png')}}"
                                    alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 style="font-family: Cairo" class="my-3">{{$information->name}}</h5>
                            <p class="text-muted mb-1">{{$information->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('teacher.profile.update', $information->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{trans('students_trans.name_ar')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name_ar"
                                                    value="{{ $information->getTranslation('name', 'ar') }}"
                                                    class="form-control" required>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{trans('students_trans.name_en')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="name_en"
                                                    value="{{ $information->getTranslation('name', 'en') }}"
                                                    class="form-control" required>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">{{trans('Students_trans.password')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </p><br><br>
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                                id="exampleCheck1" required>
                                        <label class="form-check-label" for="exampleCheck1">{{trans('main_trans.show_password')}}</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">{{trans('Students_trans.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
    @endsection
    @section('js')

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
    @endsection