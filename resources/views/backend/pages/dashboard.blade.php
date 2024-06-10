@extends('backend.layouts.main')
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Dashboard</h4>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            {{session('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        @if ($errors->any())
                            <ul style="list-style: none">
                                @foreach ($errors->all() as $error)
                                <li>
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                        {{$error}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-right">Daily</span>
                                <h5 class="card-title mb-0">Users</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        1
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-muted">1 <i
                                            class="mdi mdi-arrow-up text-success"></i></span>
                                </div>
                            </div>

                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-right">Per Week</span>
                                <h5 class="card-title mb-0">Appointments</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        1
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-muted">1 <i
                                            class="mdi mdi-arrow-down text-danger"></i></span>
                                </div>
                            </div>

                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-right">Per Month</span>
                                <h5 class="card-title mb-0">Expenses</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        1
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-muted">1 <i
                                            class="mdi mdi-arrow-up text-success"></i></span>
                                </div>
                            </div>

                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                                </div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div>
                    <!--end card-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <span class="badge badge-soft-primary float-right">All Time</span>
                                <h5 class="card-title mb-0">Daily Visits</h5>
                            </div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        1
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="text-muted">1 <i
                                            class="mdi mdi-arrow-down text-danger"></i></span>
                                </div>
                            </div>

                            <div class="progress shadow-sm" style="height: 5px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                            </div>
                        </div>
                        <!--end card body-->
                    </div><!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->


            <!--end row-->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
@endsection