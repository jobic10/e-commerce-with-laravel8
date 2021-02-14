<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')

<body class="sb-nav-fixed">
    @include('admin.partials.nav')
    <div id="layoutSidenav">
        @include('admin.partials.sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('admin.partials.footer')
        </div>
    </div>
    @include('admin.partials.scripts')
    @yield('custom_js')
</body>

</html>
