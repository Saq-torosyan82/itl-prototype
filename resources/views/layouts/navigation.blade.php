
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

{{--    <div class="slimscroll-menu">--}}
<div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>


                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="fe-airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                @if (Auth::user()->hasRole('applicant'))
                    @include('components.applicant-nav-items');
                @endif

                @if (Auth::user()->hasRole('employer'))
                    @include('components.employer-nav-items');
                @endif

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>
{{--    </div>--}}
    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
