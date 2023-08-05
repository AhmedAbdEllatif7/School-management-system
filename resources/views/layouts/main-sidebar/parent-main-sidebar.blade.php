<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{url('/parent/dashboard')}}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.parent_dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->


        <!-- الابناء-->
        <li>
            <a href="{{route('parent-dashboard.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.sons')}}</span></a>
        </li>

        <!-- تقرير الحضور والغياب-->
        <li>
            <a href="{{route('get.attendance')}}"><i class='fas fa-chalkboard-teacher' style='font-size:14px'></i>
                <span
                    class="right-nav-text"> {{trans('main_trans.attendance_absence')}}</span></a>
        </li>

        <!-- تقرير المالية-->
        <li>
            <a href="{{route('fee.parent')}}"><i class='far fa-money-bill-alt' style='font-size:14px'></i>
                <span
                    class="right-nav-text">{{ trans('main_trans.financial_report') }}</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{route('parent.profile')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
