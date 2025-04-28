@include('layouts.sidebar')
<!-- Content Wrapper -->

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        @include('layouts.navbar')
        <div class="container-fluid">

            @yield('content')

        </div>
    </div>
    @include('layouts.footer')
