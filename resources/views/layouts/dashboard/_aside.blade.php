<aside class="main-sidebar">

    <section class="sidebar" style="height: auto;">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('uploads/user_images/default.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }} </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-home"></i><span>@lang('site.dashboard')</span></a></li>


            @if (auth()->user()->hasPermission('read_consume'))
            <li><a href="{{route('consume')}}"><i class="fa fa-th"></i><span> ادخال القراءات </span></a></li>
            @endif

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>القراءات</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="{{ route('dashboard.consume') }}"><i class="fa fa-circle-o"></i> كل القراءات</a></li>
                    <li><a href="{{ route('dashboard.empty') }}"><i class="fa fa-circle-o"></i> عدادات غير مقروءة</a></li>
                    <li><a href="{{ route('dashboard.wrong') }}"><i class="fa fa-circle-o"></i> قراءات خاطئة</a></li>
                    <li><a href="{{ route('dashboard.disc') }}"><i class="fa fa-circle-o"></i> عدادات مفصولة</a></li>

                </ul>
            </li>
        
            @if (auth()->user()->hasPermission('read_clients'))
            <li><a href="{{ route('dashboard.clients.index') }}"><i class="fa fa-users"></i><span>@lang('site.clients')</span></a></li>
            @endif


            @if (auth()->user()->hasPermission('read_outlays'))

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>@lang('site.outlays')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('dashboard.outlay_categories.index') }}"><i class="fa fa-arrow-circle-down"></i><span>@lang('site.categories')</span></a></li>

                    <li><a href="{{ route('dashboard.outlays.index') }}"><i class="fa fa-arrow-circle-down"></i><span>@lang('site.outlays')</span></a></li>
                </ul>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_users'))
            <li><a href="{{ route('dashboard.users.index') }}"><i class="fa fa-user-circle-o"></i><span>@lang('site.users')</span></a></li>
            @endif
            @if (auth()->user()->hasPermission('read_importExport'))

            <li><a href="{{ route('dashboard.importExport') }}"><i class="fa fa-recycle"></i><span>تصدير / استيراد البيانات</span></a></li>

            @endif

       
        </ul>

    </section>

</aside>