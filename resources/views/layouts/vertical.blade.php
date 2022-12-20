<!DOCTYPE html>
    <html lang="en">

    <head>
        @include('layouts.shared/title-meta', ['title' => $title])
        @include('layouts.shared/head-css')
        {{-- @include('layouts.shared/head-css', ["demo" => "modern"]) --}}
    </head>

    <body @yield('body-extra')>
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.shared/topbar')

            @include('layouts.shared/left-sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">                    
                    @yield('content')
                </div>
                <!-- content -->

                @include('layouts.shared/footer')

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        @include('layouts.shared/right-sidebar')

        @include('layouts.shared/footer-script')
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
    </body>
</html>