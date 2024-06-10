@extends('backend.layouts.main')
@section('content')
<!-- App css -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/theme.min.css" rel="stylesheet" type="text/css" />
<style>
    input[type='text']{
            border: blackwhite;
        }
        .form-group{
            border-bottom: 1px solid rgba(1, 1, 1, 0.194)
        }
        .form-group.form__group{
            border-bottom: none
        }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">patients</h4>
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
                                <li class="breadcrumb-item active">patients</li>
                            </ol>
                        </div>
                        
                    </div>
                </div>
            </div>     
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Patients</h4>
                            
                            {{-- <button type="button" style="margin: 1rem 0" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#exampleModal" >Add patient</button> --}}


                            {{-- <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Scheduled Date</th>
                                        <th>Assigned patient</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($user->appointments as $appointment)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</td>
                                        <td>{{$appointment->patient->user->firstname}} {{$appointment->patient->user->lastname}}</td>
                                        <td>{{$appointment->status}}</td>
                                    </tr>
                                    @endforeach
                                    
                                    
                                    
                                </tbody>
                            </table> --}}

                            <table id="datatable-buttons" class="table table-stripednowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        {{-- <th>Action</th> --}}
                                        {{-- @if (Auth::user()->role == 'patient')
                                        <th>Action</th>
                                        @endif --}}
                                        
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{$patient->name}}</td>
                                        <td>{{$patient->email}}</td>
                                        <td>{{$patient->contact}}
                                        </td>
                                        {{-- <td>
                                            <i style="cursor: pointer" class="mdi mdi-pencil" data-toggle="modal" data-target="#editModal{{$patient->id}}"></i>
                                        </button>
                                    </td> --}}
                                    {{-- @if (Auth::user()->role == 'patient')
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#rescheduleModal{{$appointment->id}}" {{$appointment->status == 'pending' ? '' : 'disabled'}} >Reschedule</button>
                                </td>
                                    @endif --}}
                                        
                                    </tr>
                                   

                                    
                                    @endforeach
                                    
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
@endsection