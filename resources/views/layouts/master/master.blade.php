@include('layouts.master.head')

@include('layouts.master.navs')

<!-- begin::Main -->
<main class="main-content">
    @yield('content')
</main>
<!-- end::Main -->

@include('layouts.master.footer')
