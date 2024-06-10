<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Telemedicine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="DTI" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- Plugins css -->
    <link href="{{asset('plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />


        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{asset('assets/images/pbl.png')}}"> --}}

        <!-- App css -->
        <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets1/css/theme.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="layout-wrapper">
            <div class="header-border"></div>
            

            @include('backend.layouts.navbar')
            @include('backend.layouts.sidebar')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            @yield('content')

            @include('backend.layouts.footer')

        </div>
        <!-- END layout-wrapper -->

        <!-- Overlay-->
        <div class="menu-overlay"></div>


        <!-- jQuery  -->
        <script src="{{asset('assets1/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets1/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets1/js/metismenu.min.js')}}"></script>
        <script src="{{asset('assets1/js/waves.js')}}"></script>
        <script src="{{asset('assets1/js/simplebar.min.js')}}"></script>


        <!-- Sparkline Js-->
        <script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Chart Js-->
        <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>

        <!-- Chart Custom Js-->
        <script src="{{asset('assets1/pages/knob-chart-demo.js')}}"></script>


        <!-- Morris Js-->
        <script src="{{asset('plugins/morris-js/morris.min.js')}}"></script>

        <!-- Raphael Js-->
        <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>

        <!-- Custom Js -->
        <script src="{{asset('assets1/pages/dashboard-demo.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets1/js/theme.js')}}"></script>

            <!-- third party js -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{asset('assets1/pages/datatables-demo.js')}}"></script>

    </body>

</html>