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
                        <h4 class="mb-0 font-size-18">Doctors</h4>
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
                                <li class="breadcrumb-item active">Doctors</li>
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
                            
                            <button type="button" style="margin: 1rem 0" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#exampleModal" >Add Doctor</button>


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
                                        <th>Name</th>
                                        <th>Email Doctor</th>
                                        <th>Specialization</th>
                                        <th>Action</th>
                                        {{-- @if (Auth::user()->role == 'doctor')
                                        <th>Action</th>
                                        @endif --}}
                                        
                                    </tr>
                                </thead>
                            
                            
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                    <tr>
                                        <td>{{$doctor->name}}</td>
                                        <td>{{$doctor->email}}</td>
                                        <td>{{$doctor->doctor->field}}
                                        </td>
                                        <td>
                                            <i style="cursor: pointer" class="mdi mdi-pencil" data-toggle="modal" data-target="#editModal{{$doctor->id}}"></i>
                                        </button>
                                    </td>
                                    {{-- @if (Auth::user()->role == 'doctor')
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-toggle="modal" data-target="#rescheduleModal{{$appointment->id}}" {{$appointment->status == 'pending' ? '' : 'disabled'}} >Reschedule</button>
                                </td>
                                    @endif --}}
                                        
                                    </tr>
                                   

                                    <div class="modal fade" id="editModal{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('update.doctor', ['doctor' => $doctor->id])}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="simpleinput">Name</label>
                                                        <input type="text" value="{{$doctor->name}}" name="name" id="simpleinput" class="form-control" required >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Email</label>
                                                        <input type="email" value="{{$doctor->email}}" name="email" id="simpleinput" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Contact</label>
                                                        <input type="text" value="{{$doctor->contact}}" name="contact" id="simpleinput" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Specialization</label>
                                                        <input type="text" value="{{$doctor->doctor->field}}" name="field" id="simpleinput" class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button> --}}
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" >Update</button>
                                                        {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" >Decline</button> --}}
                                                    </div>
                                                    </form>
                                                    
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


            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('add.doctor')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="simpleinput">Name</label>
                                <input type="text" name="name" id="simpleinput" class="form-control" required >
                            </div>
                            <div class="form-group">
                                <label for="simpleinput">Email</label>
                                <input type="email" name="email" id="simpleinput" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="simpleinput">Contact</label>
                                <input type="text" name="contact" id="simpleinput" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="simpleinput">Specialization</label>
                                <input type="text" name="field" id="simpleinput" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button> --}}
                                <button type="submit" class="btn btn-primary waves-effect waves-light"  data-toggle="modal" >Create</button>
                                {{-- <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal" >Decline</button> --}}
                            </div>
                            </form>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
@endsection