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
                        <h4 class="mb-0 font-size-18">Appointments</h4>
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
                                <li class="breadcrumb-item active">Appointments</li>
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
                            <h4 class="card-title">Appointments</h4>

                            {{-- <table id="basic-datatable" class="table dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Scheduled Date</th>
                                        <th>Assigned Doctor</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($user->appointments as $appointment)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</td>
                                        <td>{{$appointment->doctor->user->firstname}} {{$appointment->doctor->user->lastname}}</td>
                                        <td>{{$appointment->status}}</td>
                                    </tr>
                                    @endforeach
                                    
                                    
                                    
                                </tbody>
                            </table> --}}

                            <table id="datatable-buttons" class="table table-stripednowrap">
                                <thead>
                                    <tr>
                                        <th>Scheduled Date</th>
                                        <th>
                                            @if (Auth::user()->role == 'doctor')
                                                Patient Name
                                            @elseif(Auth::user()->role == 'patient')
                                                Assigned Doctor
                                            @endif
                                            
                                        </th>
                                        <th>Status</th>
                                        <th>View</th>
                                        @if (Auth::user()->role == 'doctor')
                                        <th>Action</th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($user->appointments as $appointment)
                                    <tr>
                                        <td>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</td>
                                        <td>
                                            @if (Auth::user()->role == 'doctor')
                                                {{$appointment->patient->name}}
                                            @elseif(Auth::user()->role == 'patient')
                                                {{$appointment->doctor->user->name}}
                                            @endif
                                            {{-- {{$appointment->doctor->user->firstname}} {{$appointment->doctor->user->lastname}} --}}
                                        </td>
                                        <td>@if($appointment->status == 'Approved')
                                            <span class="badge badge-soft-success">{{$appointment->status}}</span>
                                            @elseif($appointment->status == 'Declined' || $appointment->status == 'Inactive')
                                            <span class="badge badge-soft-danger">{{$appointment->status}}</span>
                                            @else
                                            <span class="badge badge-soft-warning">{{$appointment->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <i style="cursor: pointer" class="mdi mdi-eye" data-toggle="modal" data-target="#exampleModal{{$appointment->id}}"></i>
                                            {{-- <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModal">
                                            Launch demo modal
                                        </button> --}}
                                    </td>
                                    @if (Auth::user()->role == 'doctor')
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#rescheduleModal{{$appointment->id}}" {{$appointment->status == 'pending' ? '' : 'disabled'}} >Reschedule</button>
                                </td>
                                    @endif
                                        
                                    </tr>
                                    <div class="modal fade" id="exampleModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Appointment Details</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                        <label for="inputEmail3" class="col-3 col-form-label">Scheduled Date</label>
                                                        <div class="col-9">
                                                            <p>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                        <label for="inputEmail3" class="col-3 col-form-label">Assigned Doctor</label>
                                                        <div class="col-9">
                                                            <p>{{$appointment->doctor->user->firstname}} {{$appointment->doctor->user->lastname}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                        <label for="inputEmail3" class="col-3 col-form-label">Status</label>
                                                        <div class="col-9">
                                                            
                                                            @if($appointment->status == 'Approved')
                                                            <span class="badge badge-soft-success">{{$appointment->status}}</span>
                                                            @elseif($appointment->status == 'Declined' || $appointment->status == 'Inactive')
                                                                <span class="badge badge-soft-danger">{{$appointment->status}}</span>
                                                            @else
                                                            <span class="badge badge-soft-warning">{{$appointment->status}}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($appointment->status == 'pending')
                                                <div class="modal-footer">
                                                    {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button> --}}
                                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-dismiss="modal" data-toggle="modal" data-target="#approveModal{{$appointment->id}}">Approve</button>
                                                    <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal" data-toggle="modal" data-target="#declineModal{{$appointment->id}}">Decline</button>
                                                </div>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="rescheduleModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rescheduling</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div  class="modal-body">
                                                    <form action={{route('reschedule', ['appointment' => $appointment->id])}} method="POST">
                                                        @csrf
                                                        <div class="form-group form__group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Reschedule to:</label>
                                                            <div class="col-9">
                                                                <input type="date" name="reschedule_date"  min="{{\Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control" >
                                                            </div>
                                                        </div>
                                                        @if ($appointment->status == 'pending')
                                                        <div class="modal-footer">
                                                            {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button> --}}
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Reschedule</button>
                                                        </div>
                                                        @endif
                                                        
                                                    </form>
                                                    
                                                    
                                                    {{-- <div class="form-group">
                                                        <label>Date Picker</label>
                                                        <input type="text" class="form-control" data-provide="datepicker">
                                                    </div> --}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="approveModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Approve Appointment</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div  class="modal-body">
                                                    <form action={{route('approve', ['appointment' => $appointment->id])}} method="POST">
                                                        @csrf
                                                        <h6>Are you sure you want to approve appointment with the following details:</h6>
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Scheduled Date</label>
                                                            <div class="col-9">
                                                                <p>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Assigned Doctor</label>
                                                            <div class="col-9">
                                                                <p>{{$appointment->doctor->user->firstname}} {{$appointment->doctor->user->lastname}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Status</label>
                                                            <div class="col-9">
                                                                
                                                                @if($appointment->status == 'approved')
                                                                <span class="badge badge-soft-success">{{$appointment->status}}</span>
                                                                @elseif($appointment->status == 'Declined' || $appointment->status == 'Inactive')
                                                                <span class="badge badge-soft-danger">{{$appointment->status}}</span>
                                                                @else
                                                                <span class="badge badge-soft-warning">{{$appointment->status}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($appointment->status == 'pending')
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">No</button>
                                                            
                                                        </div>
                                                        @endif
                                                        
                                                    </form>
                                                    
                                                    
                                                    {{-- <div class="form-group">
                                                        <label>Date Picker</label>
                                                        <input type="text" class="form-control" data-provide="datepicker">
                                                    </div> --}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="declineModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Decline Appointment</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div  class="modal-body">
                                                    <form action={{route('decline', ['appointment' => $appointment->id])}} method="POST">
                                                        <h6>Are you sure you want to decline appointment with the following details:</h6>
                                                        @csrf
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Scheduled Date</label>
                                                            <div class="col-9">
                                                                <p>{{\Carbon\Carbon::parse($appointment->scheduled_at)->format('jS F, Y')}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Assigned Doctor</label>
                                                            <div class="col-9">
                                                                <p>{{$appointment->doctor->user->firstname}} {{$appointment->doctor->user->lastname}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-3" style="display: flex; align-items:center; justify-content:center">
                                                            <label for="inputEmail3" class="col-3 col-form-label">Status</label>
                                                            <div class="col-9">
                                                                
                                                                @if($appointment->status == 'approved')
                                                                <span class="badge badge-soft-danger">{{$appointment->status}}</span>
                                                                @elseif($appointment->status == 'Declined' || $appointment->status == 'Inactive')
                                                                <span class="badge badge-soft-success">{{$appointment->status}}</span>
                                                                @else
                                                                <span class="badge badge-soft-warning">{{$appointment->status}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if ($appointment->status == 'pending')
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Yes</button>
                                                            <button type="button" class="btn btn-danger waves-effect waves-light" data-dismiss="modal">No</button>
                                                            
                                                        </div>
                                                        @endif
                                                    </form>
                                                    
                                                    
                                                    {{-- <div class="form-group">
                                                        <label>Date Picker</label>
                                                        <input type="text" class="form-control" data-provide="datepicker">
                                                    </div> --}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
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