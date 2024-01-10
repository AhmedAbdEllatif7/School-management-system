@extends('layouts.master')
    @section('css')
        @livewireStyles
        @section('title')
            {{trans('students_trans.do_quiz')}}
        @stop
    @endsection
    @section('page-header')
        @section('PageTitle')
            {{trans('students_trans.do_quiz')}}
        @stop
    @endsection
    @section('content')
        @livewire('show-questions', ['quizze_id' => $quiz_id, 'student_id' => $student_id])
    @endsection
    @section('js')
        @livewireScripts
    @endsection
