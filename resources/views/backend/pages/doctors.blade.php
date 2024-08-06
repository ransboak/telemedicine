@extends('backend.layouts.main')
@section('content')

<style>
    input[type='text'] {
        border: blackwhite;
    }
    .form-group {
        border-bottom: 1px solid rgba(1, 1, 1, 0.194);
    }
    .form-group.form__group {
        border-bottom: none;
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

                            <table id="doctors-table" class="table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Specialization</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTable will populate this section -->
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

            <!-- Add Doctor Modal -->
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
                            <form action="{{ route('add.doctor') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="simpleinput">Name</label>
                                <input type="text" name="name" id="simpleinput" class="form-control" required>
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
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic Edit Doctor Modal -->
            <div class="modal fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                            <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editDoctorForm" action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="editName">Name</label>
                                    <input type="text" name="name" id="editName" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="editEmail">Email</label>
                                    <input type="email" name="email" id="editEmail" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="editContact">Contact</label>
                                    <input type="text" name="contact" id="editContact" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="editField">Specialization</label>
                                    <input type="text" name="field" id="editField" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    const updateDoctorUrl = "{{ route('update.doctor', ['doctor' => ':id']) }}";
    $('#doctors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('view.doctors') }}',
            type: 'GET',
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'specialization', name: 'specialization' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        dom: 'Bfrtip',
    });

    // Handle Edit Button Click
    $('#doctors-table').on('click', '.edit-doctor', function() {
        // Retrieve doctor data from button attributes
        const doctorId = $(this).data('id');
        const doctorName = $(this).data('name');
        const doctorEmail = $(this).data('email');
        const doctorContact = $(this).data('contact');
        const doctorField = $(this).data('field');

        // Set form values
        $('#editDoctorForm').attr('action', updateDoctorUrl.replace(':id', doctorId));
        $('#editName').val(doctorName);
        $('#editEmail').val(doctorEmail);
        $('#editContact').val(doctorContact);
        $('#editField').val(doctorField);

        // Show the modal
        $('#editDoctorModal').modal('show');
    });
});
</script>

@endsection
