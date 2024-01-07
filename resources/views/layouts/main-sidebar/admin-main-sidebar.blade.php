<div class="scrollbar side-menu-bg">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('main_trans.Grades_list')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('grades.index')}}">{{trans('main_trans.Grades_list')}}</a></li>
            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{trans('main_trans.Classes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('classrooms.index')}}">{{trans('main_trans.List_classes')}}</a></li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{trans('main_trans.Sections')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('sections.index')}}">{{trans('main_trans.List_sections')}}</a></li>
            </ul>
        </li>


        <!-- students-->

        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <i class="fas fa-user-graduate"></i>{{trans('main_trans.students')}}
                <div class="pull-right">
                    <i class="ti-plus"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">
                        {{trans('main_trans.Student_information')}}
                        <div class="pull-right">
                            <i class="ti-plus"></i>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li>
                            <a href="{{route('students.index')}}">{{__('main_trans.Student List')}}</a>
                        </li>
                        <li>
                            <a href="{{route('students.create')}}">{{trans('main_trans.add_student')}}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">
                        {{trans('main_trans.Students_Promotions')}}
                        <div class="pull-right">
                            <i class="ti-plus"></i>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li></li>
                            <a href="{{route('student-promotions.index')}}">{{__('main_trans.Student promotion')}}</a>
                        </li>
                        <li>
                            <a href="{{route('student-promotions.create')}}">{{__('main_trans.Manage student promotion')}}</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate_students">
                        {{trans('main_trans.Graduate_students')}}
                        <div class="pull-right">
                            <i class="ti-plus"></i>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate_students" class="collapse">
                        <li>
                            <a href="{{route('graduation.index')}}">{{trans('main_trans.list_Graduate')}}</a>
                        </li>
                        <li>
                            <a href="{{route('graduation.create')}}">{{trans('main_trans.add_Graduate')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{trans('main_trans.Teachers')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('teachers.index')}}">{{trans('main_trans.List_Teachers')}}</a> </li>
            </ul>

            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('teachers.create')}}">{{ trans('teacher_trans.Add_Teacher') }}</a> </li>
            </ul>
        </li>


        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{trans('main_trans.Parents')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('parents.index')}}">{{trans('main_trans.List_Parents')}}</a> </li>
            </ul>

        </li>

        <!-- Accounts-->

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{trans('main_trans.Accounts')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('fees.create')}}">{{(trans('main_trans.add_fees'))}} </a> </li>
                <li> <a href="{{route('fees.index')}}">{{(trans('main_trans.Fees_list'))}}</a> </li>
                <li> <a href="{{route('invoices-fees.index')}}">{{(trans('main_trans.Invoices_fees_list'))}}</a> </li>
                <li> <a href="{{route('student-receipt.index')}}">{{(trans('students_trans.student_receipt'))}}</a> </li>
                <li> <a href="{{route('processing_fees.index')}}">{{(trans('students_trans.exclude_fee_list'))}}</a> </li>
                <li> <a href="{{route('payments_student.index')}}">{{(trans('students_trans.payments_student_list'))}}</a> </li>


            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('main_trans.Attendance')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('attendance.index')}}">{{(trans('main_trans.Student List'))}}</a> </li>
            </ul>
        </li>

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subject-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('main_trans.Subjects')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subject-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('subjects.index')}}">{{trans('main_trans.Subjects_list')}}</a> </li>
            </ul>
        </li>

{{--        <!-- Quizzes-->--}}
{{--        <li>--}}
{{--            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">--}}
{{--                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('main_trans.quizzes')}}</span></div>--}}
{{--                <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </a>--}}
{{--            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">--}}
{{--                <li> <a href="{{route('quizzes.create')}}">{{trans('main_trans.add_quiz')}}</a> </li>--}}
{{--                <li> <a href="{{route('quizzes.index')}}">{{trans('main_trans.quizzes_list')}}</a> </li>--}}
{{--                <li> <a href="{{route('questions.index')}}">{{trans('students_trans.question_list')}}</a> </li>--}}
{{--                <li> <a href="{{route('questions.create')}}">{{trans('students_trans.add_new_question')}}</a> </li>--}}

{{--            </ul>--}}
{{--        </li>--}}


        <!-- library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('main_trans.library')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('libraries.index')}}">{{trans('main_trans.books_list')}}</a> </li>
                <li> <a href="{{route('libraries.create')}}">{{trans('students_trans.add_new_book')}}</a> </li>

            </ul>
        </li>


{{--        <!-- Onlinec lasses-->--}}
{{--        <li>--}}
{{--            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">--}}
{{--                <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></div>--}}
{{--                <div class="pull-right"><i class="ti-plus"></i></div>--}}
{{--                <div class="clearfix"></div>--}}
{{--            </a>--}}
{{--            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">--}}
{{--                <li> <a href="fontawesome-icon.html">font Awesome</a> </li>--}}
{{--                <li> <a href="themify-icons.html">Themify icons</a> </li>--}}
{{--                <li> <a href="weather-icon.html">Weather icons</a> </li>--}}
{{--            </ul>--}}
{{--        </li>--}}


        <!-- Settings-->
        <li>
            <a href="{{url('settings')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('main_trans.Settings')}} </span></a>
        </li>





    </ul>
</div>
