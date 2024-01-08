@extends('layouts.master')
    @section('css')
        @section('title')
            {{trans('main_trans.settings')}}
        @stop
        @section('PageTitle')
            {{trans('main_trans.settings')}}
        @stop
    @endsection
    @section('content')
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <!-- row -->
    <!-- Add this section within your content section -->
    <div class="row">
        <div class="col-md-12 mb-4">
            @if(isset($settings['logo']))
                <img src="{{ asset('attachments/logo/'.$settings['logo']) }}" alt="Logo" width="200px" height="200px">
            @else
                <p>No logo found.</p>
            @endif
            <br>
            <br>
            <!-- Your form code goes here -->
            <form method="POST" action="{{ route('settings.update', 'error') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach($settings as $key => $value)
                        @if($key !== 'logo') <!-- Exclude the 'logo' key from the form -->
                            <div class="col-md-6 border-right-2 border-right-blue-400 mb-4">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">{{ ucfirst(str_replace('_', ' ', $key)) }}<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="settings[{{ $key }}]" value="{{ $value }}" type="text" class="form-control mr-2" placeholder="{{ ucfirst(str_replace('_', ' ', $key)) }}" required>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-6 border-right-2 border-right-blue-400 mb-4">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Update Logo<span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="logo" type="file" class="form-control mr-2">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="col-lg-12 text-left">
                    <button type="submit" style="font-size: 0.95em;" class="btn btn-success btn-sm">Update All</button>
                </div>
            </form>
        </div>
    </div>

    <!-- row closed -->

    <!-- row closed -->
    @endsection
    @section('js')

    @endsection
