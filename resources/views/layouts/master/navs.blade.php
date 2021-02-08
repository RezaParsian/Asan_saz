<!-- begin::navigation -->
<div class="navigation">
        <div class="navigation-icon-menu">
            <ul>
                <li data-toggle="tooltip" title="داشبورد" class="{{Menu::SetActive("dashboard")}}">
                    <a href="#navigationDashboards" title="داشبوردها">
                        <i class="icon ti-pie-chart"></i>
                        {{-- <span class="badge badge-warning">2</span>
                        --}}
                    </a>

            </ul>

            <ul>
                <li data-toggle="tooltip" title="خروج">
                    <form id="logout" action="{{route("logout")}}" method="post">
                        @csrf
                        <a onclick="$('#logout').submit()" class="go-to-page">
                            <i class="icon ti-power-off go-to-page"></i>
                        </a>
                    </form>
                </li>
            </ul>
        </div>

        <div class="navigation-menu-body">
            <ul id="navigationDashboards" class="{{Menu::SetActive("dashboard")}}">
                <li><a class="{{Menu::SetActive("dashboard")}}" href="{{route("home")}}">صفحه نخست</a></li>
                <li><a  href="{{route("user.index")}}">لیست کاربران</a></li>
                <li><a  href="{{route("user.create")}}">ایجاد کاربر</a></li>
                <li><a  href="{{route("category.index")}}">دسته بندی ها</a></li>
                <li><a  href="{{route("category.create")}}">ایجاد دسته بندی</a></li>
            </ul>
        </div>
</div>
<!-- end::navigation -->
<!-- begin::header -->
<div class="header">

    <!-- begin::header logo -->
    <div class="header-logo">
        <a href="#">
            <img class="large-logo" src="{{ asset('assets/media/image/logo.png') }}" alt="...">
            <img class="small-logo" src="{{ asset('assets/media/image/logo-sm.png') }}" alt="...">
            <img class="dark-logo" src="{{ asset('assets/media/image/logo-dark.png') }}" alt="...">
        </a>
    </div>
    <!-- end::header logo -->

    <!-- begin::header body -->
    <div class="header-body">

        <div class="header-body-left">

            <h3 class="page-title">@yield('ex-title')</h3>

            {{-- <!-- begin::breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="#">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">داشبورد سایت</li>
                </ol>
            </nav>
            <!-- end::breadcrumb --> --}}

        </div>

        <div class="header-body-right">
            <!-- begin::navbar main body -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link bg-none" data-sidebar-open="#userProfile">
                        <div>
                            <figure class="avatar avatar-state-success avatar-sm">
                                <img src="{{asset("upload/img/defult.png")}}" class="rounded-circle"
                                    alt="image">
                            </figure>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- end::navbar main body -->

            <div class="d-flex">
                <!-- begin::navbar navigation toggler -->
                <div class="d-xl-none d-lg-none d-sm-block navigation-toggler">
                    <a href="#">
                        <i class="ti-menu"></i>
                    </a>
                </div>
                <!-- end::navbar navigation toggler -->

                <!-- begin::navbar toggler -->
                <div class="d-xl-none d-lg-none d-sm-block navbar-toggler">
                    <a href="#">
                        <i class="ti-arrow-down"></i>
                    </a>
                </div>
                <!-- end::navbar toggler -->
            </div>
        </div>

    </div>
    <!-- end::header body -->

</div>
<!-- end::header -->

<!-- begin::sidebar user profile -->
<div class="sidebar" id="userProfile">
    <div class="text-center p-4">
        <figure class="avatar avatar-state-success avatar-lg mb-4">
            <img src="{{asset("upload/img/defult.png")}}" class="rounded-circle" alt="image">
        </figure>
        <h4 class="text-primary m-b-10">{{ Auth::user()->name }}</h4>
        <p class="text-muted d-flex align-items-center justify-content-center line-height-0 mb-0">
            {{ Auth::user()->email }}
            {{-- <a href="#" class="ml-2" data-toggle="tooltip" title="تنظیمات"
                data-sidebar-open="#settings"> <i class="ti-settings"></i> </a> --}}
        </p>
    </div>
    <hr class="m-0">
    {{-- <div class="p-4">
        <div class="mb-4">
            <h6 class="font-size-13 mb-3 pt-2">درباره</h6>
            <p class="text-muted">{{ Auth::user()->info }}</p>
        </div>
        <div class="mb-4">
            <h6 class="font-size-13 mb-3">شهر</h6>
            <p class="text-muted">{{ Auth::user()->city_id }}</p>
        </div>
        <div class="mb-4">
            <h6 class="font-size-13 mb-3">شبکه های اجتماعی</h6>
            <ul class="list-inline mb-4">
                <li class="list-inline-item">
                    <a href="#" class="btn btn-sm btn-floating btn-facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="btn btn-sm btn-floating btn-twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="btn btn-sm btn-floating btn-dribbble">
                        <i class="fa fa-dribbble"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="btn btn-sm btn-floating btn-whatsapp">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="btn btn-sm btn-floating btn-linkedin">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div> --}}
</div>
<!-- end::sidebar user profile -->
