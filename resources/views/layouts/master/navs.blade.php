<!-- begin::navigation -->
<div class="navigation">
    @if (Auth::user()->roll == 'User' || (!request()->is('admin') && !request()->is('admin/*')))
        <div class="navigation-icon-menu">
            <ul>
                <li data-toggle="tooltip" title="داشبورد" class="{{ Rp76::set_active(['dashboard']) }}">
                    <a href="#navigationDashboards" title="داشبوردها">
                        <i class="icon ti-pie-chart"></i>
                        {{-- <span class="badge badge-warning">2</span>
                        --}}
                    </a>
                </li>
                <li data-toggle="tooltip" title="شماره ها" class="{{ Rp76::set_active(['store', 'mynumber']) }}">
                    <a href="#shomareha" title="شماره ها">
                        <i class="icon ti-agenda"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" title="آگهی ها"
                    class="{{ Rp76::set_active(['adslist', 'adsadd', 'adssame']) }}">
                    <a href="#agahi">
                        <i class="icon fa fa-buysellads"></i>
                    </a>
                </li>
                {{-- <li data-toggle="tooltip" title="چت ها">
                    <a href="#chat">
                        <i class="icon fa fa-comment"></i>
                    </a>
                </li> --}}
                <li data-toggle="tooltip" title="اعتبار" class="{{ Rp76::set_active(['transaction']) }}">
                    <a href="#etebar" title="اعتبار">
                        <i class="icon fa fa-money"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" title="امکانات" class="{{ Rp76::set_active(['newticket', 'ticketlist','logs','makemotaradeff']) }}">
                    <a href="#emkanat" title="امکانات">
                        <i class="icon fa fa-puzzle-piece"></i>
                    </a>
                </li>
                {{-- <li data-toggle="tooltip" title="تنظیمات">
                    <a href="#tanzimat">
                        <i class="icon ti-settings"></i>
                    </a>
                </li> --}}
            </ul>

            <ul>
                <li data-toggle="tooltip" title="خروج">
                    <form id="logout" action="{{ route('logout') }}" method="post">
                        @csrf
                        <a onclick="$('#logout').submit()" class="go-to-page">
                            <i class="icon ti-power-off go-to-page"></i>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
        <div class="navigation-menu-body">
            <ul id="navigationDashboards" class="{{ Rp76::set_active(['dashboard']) }}">
                <li>
                    <a class="{{ Rp76::set_active(['dashboard']) }}" href="{{ route('mainpage') }}">صفحه نخست</a>
                </li>
                {{-- <li><a href="#">پروفایل</a></li> --}}
            </ul>

            <ul id="shomareha" class="{{ Rp76::set_active(['store', 'mynumber']) }}">
                <li>
                    <a href="{{ route('store.view') }}" class="{{ Rp76::set_active('store') }}">خرید شماره جدید</a>
                </li>
                <li>
                    <a href="{{ route('store.mynumber') }}" class="{{ Rp76::set_active('mynumber') }}">لیست شماره های
                        من</a>
                </li>
                <li>
                    {{-- <a href="#">اضافه کردن شماره</a> --}}
                </li>
            </ul>

            <ul id="agahi" class="{{ Rp76::set_active(['adslist', 'adsadd', 'adssame', 'adsadds']) }}">
                <li><a href="{{ route('ads.add') }}" class="{{ Rp76::set_active('adsadd') }}">درج آگهی تکی</a></li>
                <li><a href="{{ route('ads.adds') }}" class="{{ Rp76::set_active('adsadds') }}">درج آگهی انبوه</a></li>
                <li><a href="{{ route('ads.same') }}" class="{{ Rp76::set_active('adssame') }}">آگهی های مشابه</a></li>
                <li><a href="{{ route('ads.list') }}" class="{{ Rp76::set_active('adslist') }}">آگهی های من</a></li>
            </ul>

            <ul id="chat">
                <li><a href="#">چت ها</a></li>
                <li><a href="#">مدیریت چت ها</a></li>
            </ul>

            <ul id="etebar" class="{{ Rp76::set_active(['transaction']) }}">
                {{-- <li><a href="#">افزایش اعتبار</a></li>
                --}}
                <li><a href="{{ route('transaction') }}" class="{{ Rp76::set_active('transaction') }}">تراکنش مالی</a>
                </li>
            </ul>

            <ul id="emkanat" class="{{ Rp76::set_active(['newticket', 'ticketlist', 'ticket/*','logs','makemotaradeff']) }}">
                <li><a href="{{route("mkkmot")}}" class="{{ Rp76::set_active('makemotaradeff') }}">متن غیر تکراری</a></li>
                {{-- <li><a href="#">ثبت تلفن ثابت</a></li>
                --}}
                {{-- <li><a href="#">وب سروس</a></li> --}}
                <li><a href="{{ route('ticket.add') }}" class="{{ Rp76::set_active('newticket') }}">پشتیبانی (تیکت)</a>
                </li>
                <li><a href="{{ route('ticket.list') }}" class="{{ Rp76::set_active(['ticketlist', 'ticket/*']) }}">درخواست های پشتیبانی</a></li>
                <li><a href="{{ route('logs') }}" class="{{ Rp76::set_active('logs') }}">گزارشات</a></li>
            </ul>

            <ul id="tanzimat">
                <li><a href="#">مدارک</a></li>
                <li><a href="#">تغیر رمز ورود</a></li>
                <li><a href="#">گزارشات ورود</a></li>
            </ul>
        </div>
    @endif
    @if (Auth::user()->roll != 'User' && (request()->is('admin/*') || request()->is('admin')))
        <div class="navigation-icon-menu">
            <ul>
                <li data-toggle="tooltip" title="مانیتورینگ"
                    class="{{ Rp76::set_active(['admin', 'admin-panel', 'admin/manitor']) }}">
                    <a href="#manitor" title="مانیتورینگ">
                        <i class="fa fa-search text-white"></i>
                        {{-- <span class="badge badge-warning">2</span>
                        --}}
                    </a>
                </li>
                <li data-toggle="tooltip" title="ابزار مدیریتی"
                    class="{{ Rp76::set_active(['admin/phones', 'admin/phone_add', 'admin/phone_view/*', 'admin/discounts', 'admin/discount/*']) }}">
                    <a href="#modirtool" title="ابزار مدیریتی">
                        <i class="fa fa-wrench text-white"></i>
                    </a>
                </li>
                {{-- <li data-toggle="tooltip" title="پرداخت ها">
                    <a href="#pay">
                        <i class="text-white fa fa-usd"></i>
                    </a>
                </li> --}}
                {{-- <li data-toggle="tooltip" title="درخواست ها">
                    <a href="#darkhast" title="درخواست ها">
                        <i class="text-white fa fa-question"></i>
                    </a>
                </li> --}}
                {{-- <li data-toggle="tooltip" title="اخبار">
                    <a href="#news">
                        <i class="fa fa-newspaper-o text-white"></i>
                    </a>
                </li> --}}
                {{-- <li data-toggle="tooltip" title="کارشناس فروش">
                    <a href="#karshenas">
                        <i class="fa fa-users text-white"></i>
                    </a>
                </li> --}}
                <li data-toggle="tooltip" class="{{ Rp76::set_active(['admin/tarefe','admin/ticketlist','admin/ticket/*']) }}" title="تنظیمات">
                    <a href="#adminsetting">
                        <i class="icon ti-settings"></i>
                    </a>
                </li>
                {{-- <li data-toggle="tooltip" title="مدیرکل">
                    <a href="#allmodir">
                        <i class="fa fa-adn text-white"></i>
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="navigation-menu-body">
            <ul id="manitor" class="{{ Rp76::set_active(['admin', 'admin-panel', 'admin/manitor']) }}">
                <li>
                    <a class="{{ Rp76::set_active('admin') }}" href="{{ route('admin-panel') }}">داشبورد</a>
                </li>
                <li>
                    <a href="{{ route('admin-monitor') }}" class="{{ Rp76::set_active('admin/manitor') }}">مانیتورینگ
                        کاربران</a>
                </li>
                {{-- <li><a href="#">کاربران آنلاین</a></li>
                --}}
            </ul>

            <ul id="modirtool"
                class="{{ Rp76::set_active(['admin/phones', 'admin/phone_add', 'admin/phone_view/*', 'admin/discounts', 'admin/discount/*', 'admin/motardef', 'admin/addmotardef', 'admin/viewmotardef/*']) }}">
                {{-- <li>
                    <a href="#">ثبت دامنه نمایندگی</a>
                </li> --}}
                <li>
                    <a href="{{ route('phone.list') }}"
                        class="{{ Rp76::set_active(['admin/phones', 'admin/phone_add', 'admin/phone_view/*']) }}">شماره
                        ها</a>
                </li>
                {{-- <li>
                    <a href="#">درخواست انتقال شماره</a>
                </li> --}}
                <li>
                    <a href="{{ route('discount.list') }}"
                        class="{{ Rp76::set_active(['admin/discounts', 'admin/discount/*']) }}">کد تخفیف</a>
                </li>
                {{-- <li>
                    <a href="#">لوگو و دامنه</a>
                </li> --}}
                {{-- <li>
                    <a href="#">اطلاعات تماس</a>
                </li> --}}
                {{-- <li>
                    <a href="#">مدیریت لینک</a>
                </li> --}}
                {{-- <li>
                    <a href="#">ایجاد کاربر</a>
                </li> --}}
                {{-- <li>
                    <a href="#">مدیریت کاربران</a>
                </li> --}}
                <li><a href="{{ route('Motaradef.list') }}"
                        class="{{ Rp76::set_active(['admin/motardef', 'admin/addmotardef', 'admin/viewmotardef/*']) }}">مترادف</a>
                </li>
            </ul>

            {{-- <ul id="pay">
                <li>
                    <a href="#">مدیریت تراکنش</a>
                </li>
                <li>
                    <a href="#">درگاه پرداخت</a>
                </li>
            </ul> --}}

            {{-- <ul id="darkhast">
                <li><a href="#">مالی</a></li>
                <li><a href="#">سوال</a></li>
                <li><a href="#">وبسرویس</a></li>
                <li><a href="#">پشنهادات</a></li>
                <li><a href="#">مدرک منتظر تایید</a></li>
                <li><a href="#">خط انتقالی در لیست بررسی</a></li>
            </ul> --}}

            {{-- <ul id="news">
                <li><a href="#">درج خبر</a></li>
                <li><a href="#">درج اعلان</a></li>
                <li><a href="#">لیست اعلان</a></li>
            </ul> --}}

            {{-- <ul id="karshenas">
                <li><a href="#">ورژن بعدی</a></li>
            </ul> --}}

            <ul id="adminsetting" class="{{ Rp76::set_active(['admin/tarefe','admin/ticketlist','admin/ticket/*']) }}">
                <li><a href="{{ route('admin.ticketlist') }}" class="{{Rp76::set_active(['admin/ticketlist','admin/ticket*']) }}">تیکت ها</a></li>
                {{-- <li><a href="#">مدیریت بسته ها</a></li>
                --}}
                <li><a href="{{ route('tarefe.view') }}" class="{{ Rp76::set_active('admin/tarefe') }}">مدیریت تعرفه ها</a></li>
                {{-- <li><a href="#">تعرفه خطوط</a></li> --}}

            </ul>

            {{-- <ul id="allmodir">
                <li><a href="#">مدیریت راهنما</a></li>
                <li><a href="#">بازگشت درگاه</a></li>
                <li><a href="#">دامنه های کاربران</a></li>
            </ul> --}}
        </div>
    @endif
</div>
<!-- end::navigation -->
<!-- begin::header -->
<div class="header">

    <!-- begin::header logo -->
    <div class="header-logo">
        <a href="{{ route('mainpage') }}">
            <img class="large-logo" src="{{ asset('assets/media/image/logo.png') }}" alt="...">
            <img class="small-logo" src="{{ asset('assets/media/image/logo-sm.png') }}" alt="...">
            <img class="dark-logo" src="{{ asset('assets/media/image/logo-dark.png') }}" alt="...">
        </a>
    </div>
    <!-- end::header logo -->

    <!-- begin::header body -->
    <div class="header-body">

        <div class="header-body-left">

            <h3 class="page-title">@yield('extitle')</h3>

            <!-- begin::breadcrumb -->
            <nav aria-label="breadcrumb">
                {{-- <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('mainpage') }}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">داشبورد سایت</li>
                </ol> --}}
            </nav>
            <!-- end::breadcrumb -->

        </div>

        <div class="header-body-right">
            <!-- begin::navbar main body -->
            <ul class="navbar-nav">
                @if (Auth::user()->roll != 'User')
                    @if (request()->is('admin*'))
                        <li class="nav-item dropdown">
                            <a href="{{ route('mainpage') }}" title="user panel" class="nav-link">
                                <i class="fa fa-users"></i>
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="{{ route('admin-panel') }}" title="admin panel" class="nav-link">
                                <i class="fa fa-street-view"></i>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link bg-none" data-sidebar-open="#userProfile">
                        <div>
                            <figure class="avatar avatar-state-success avatar-sm">
                                <img src="{{ asset('upload/img/' . Auth::user()->image) }}" class="rounded-circle"
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
            <img src="{{ asset('upload/img/' . Auth::user()->image) }}" class="rounded-circle" alt="image">
        </figure>
        <h4 class="text-primary m-b-10">{{ Auth::user()->name }}</h4>
        <p class="text-muted d-flex align-items-center justify-content-center line-height-0 mb-0">
            {{ Auth::user()->email }}
            {{-- <a href="#" class="ml-2" data-toggle="tooltip" title="تنظیمات"
                data-sidebar-open="#settings"> <i class="ti-settings"></i> </a> --}}
        </p>
    </div>
    <hr class="m-0">
    <div class="p-4">
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
    </div>
</div>
<!-- end::sidebar user profile -->
