<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard--><!-- Add this before the closing </body> tag -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <!-- الاقسام-->
        <li>
            <a href="{{route('sections.index')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{trans('main_trans.Sections')}}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('students.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.Students')}}</span></a>
        </li>


        <li>
            <a href="{{route('attendance.index')}}"><i class="fas fa-chalkboard"></i><span
                class="right-nav-text">{{ trans('main_trans.attendance') }}</span></a>
        </li>


        <li>
            <a href="{{route('reports.index')}}">
                <i class="fas fa-chalkboard"></i>
                <span
                    class="right-nav-text">{{ trans('main_trans.reports') }}
                </span>
            </a>
        </li>


        <li>
            <a href="{{route('quizzes.index')}}">
                <i class="fas fa-chalkboard"></i>
                <span
                    class="right-nav-text">{{ trans('main_trans.quizzes') }}
                </span>
            </a>
        </li>



        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('teacher.profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('main_trans.profile')}}</span></a>
        </li>

    </ul>
</div>
