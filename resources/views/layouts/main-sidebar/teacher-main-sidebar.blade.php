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
            <a href="{{route('sectionInformation')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{trans('main_trans.Sections')}}</span></a>
        </li>

        <!-- الطلاب-->
        <li>
            <a href="{{route('studentInformation')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.Students')}}</span></a>
        </li>


        <!-- الاختبارات-->

        <!-- Quiz menu -->
        <li>
            <a href="javascript:void(0);" onclick="toggleSubMenu('quiz-menu')">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span class="right-nav-text">{{trans('main_trans.quizzes')}}</span></div>
                <div class="pull-right"><i id="quiz-icon" class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="quiz-menu" style="display: none;">
                <li><a href="{{route('quizzes-teacher.index')}}">{{trans('main_trans.quizzes_list')}}</a></li>
            </ul>
        </li>

        <!-- Sections menu -->
        <li id="sections-menu-parent">
            <a href="javascript:void(0);" onclick="toggleSubMenu('sections-menu')">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span class="right-nav-text">{{ trans('main_trans.report') }}</span></div>
                <div class="pull-right"><i id="sections-icon" class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" style="display: none;">
                <li><a href="{{route('attendanceReport')}}">{{ trans('main_trans.attendance_absence') }}</a></li>
            </ul>
        </li>

        <script>
            function toggleSubMenu(menuId) {
                var subMenu = document.getElementById(menuId);
                var icon = document.getElementById(menuId + '-icon');

                if (subMenu.style.display === 'none') {
                    subMenu.style.display = 'block';
                    icon.classList.remove('ti-plus');
                    icon.classList.add('ti-minus');
                } else {
                    subMenu.style.display = 'none';
                    icon.classList.remove('ti-minus');
                    icon.classList.add('ti-plus');
                }
            }
        </script>


        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('main_trans.profile')}}</span></a>
        </li>

    </ul>
</div>
