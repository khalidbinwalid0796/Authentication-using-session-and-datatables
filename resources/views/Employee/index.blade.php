<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/datatables.bundle7.0.8.css')}}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" crossorigin="anonymous">
    <style>
    /* dropify-message size reduce */
    .dropify-message .file-icon p {
            font-size: 14px !important;
        }
    /* passe na ty custom css apply */
    .dropdown-menu{
        display: block !important;
    }
    .badge{
        color:blue !important;
    }
    /* end passe na ty custom css apply */
    </style>
</head>
<body>
<!-- Add Modal for data inserting -->
<div class="modal fade" id="addEmployeeModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="storeForm" enctype="multipart/form-data">
            @csrf        
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <span class="text-danger">All (*) mark fields are required.</span>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required="required" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required="required" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" required="required" placeholder="Enter mobile no">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role_id" required="required" class="form-control">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required="required" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required="required" placeholder="Enter password again">
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <select id="district_id" name="district_id" onchange="upazilaList(this.value,'storeForm')" required="required" class="form-control">
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upazila</label>
                        <select name="upazila_id" id="upazila_id" class="form-control" required="required">
                            <option value="">Select Upazila</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" name="postal_code" required="required" placeholder="Enter postal code">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" required="required" placeholder="Enter address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group col-md-12">
                        <input type="file" class="dropify" name="avatar" id="avatar" data-show-errors="true" data-errors-position="outside"
                        data-allowed-file-extensions="jpg jpeg png svg webp gif">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary add_employee">Save</button>
        </div>
    </form>
      </div>
    </div>
</div>
 <!-- Add Modal for data inserting -->
 <!-- Add Modal for data Edit -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" id="editForm" enctype="multipart/form-data">
            @csrf     
            <input type="hidden" name="update_id" id="update_id">   
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <span class="text-danger">All (*) mark fields are required.</span>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-8">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter mobile no">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <select id="district_id" name="district_id" onchange="upazilaList(this.value,'editForm')" class="form-control">
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upazila</label>
                        <select name="upazila_id" id="upazila_id" class="form-control">
                            <option value="">Select Upazila</option> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" class="form-control" name="postal_code" id="postal_code" placeholder="Enter postal code">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group col-md-12">
                        <input type="file" class="dropify" name="avatar" id="avatar" data-show-errors="true" data-errors-position="outside"
                        data-allowed-file-extensions="jpg jpeg png svg webp gif">
                        <input type="hidden" name="old_avatar" id="old_avatar">
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary edit_employee">Update</button>
        </div>
    </form>
      </div>
    </div>
</div>
 <!-- Add Modal for data edit -->

 <!-- view modal  -->
<div class="modal" id="viewDataModal" tabindex="-1" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="view_data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


 <!--  view modal end  -->



 <div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            User List
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                Add Employee
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form mathod="POST" id="form-filter">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Email</label>
                                    <input type="email" id="email" placeholder="Enter Email" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Mobile No</label>
                                    <input type="text" id="mobile_no" placeholder="Enter mobile no" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Select Role</label>
                                    <select id="role_id" required="required" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Select District</label>
                                    <select id="district_id" name="district_id" onchange="upazilaList(this.value,'form-filter')" required="required" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                                <div class="form-group col-md-3">
                                    <label>Select Upazila</label>
                                    <select name="upazila_id" id="upazila_id" class="form-control" required="required">
                                        <option value="">Select Upazila</option> 
                                    </select>
                                </div>                               
                                <div class="form-group col-md-3">
                                    <label>Select Please</label>
                                    <select id="status" class="form-control">
                                        <option value="">Select Please</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>                                                                                                                 
                                <div class="form-group col-md-3" style="padding-top:30px;">
                                    <button type="button" class="btn btn-success"  id="btn-filter">Search</button>
                                    <button type="reset" class="btn btn-danger" style="margin-left:5px;" id="btn-reset">Reset</button>
                                </div>  
                        </div>
                    </form>  
                        </div>
                        <div class="col-md-12 mt-5">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>District</th>
                                    <th>Upazila</th>
                                    <th>Postal Code</th>
                                    <th>Verified Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- jquery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
    <script src="{{ asset('js/datatables.bundle7.0.8.js')}}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js')}}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>

    <script>
//employee list
    var table;
    $(document).ready(function () {
        let _token = "{{csrf_token()}}";

        table = $('#dataTable').DataTable({
            "processing": true, //Feature control the processing indicator
            "serverSide": true, //Feature control DataTable server side processing mode
            "order": [], //Initial no order
            "responsive": true, //Make table responsive in mobile device
            "bInfo": true, //TO show the total number of data
            "bFilter": false, //For datatable default search box hide
            "lengthMenu": [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1], //key
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"] //value
            ],
            "pageLength": 5, //number of data show per page
            "language": {
                processing: `<img src="{{asset('svg/table-loading.svg')}}" alt="Loading...."/>`, //loading image show
                emptyTable: '<strong class="text-danger">No Data Found</strong>', //data na thakle 
                infoEmpty: '', //data na thakle
                zeroRecords: '<strong class="text-danger">No Data Found</strong>' //data na thakle
            },
            "ajax": {
                "url": "{{route('employee.list')}}",
                "type": "POST",
                "data": function (data) {
                    //url ar sathe ai data gulo pass hoye jabe
                    data.name = $('#form-filter #name').val();
                    data.email = $('#form-filter #email').val();
                    data.mobile_no = $('#form-filter #mobile_no').val();
                    data.role_id = $('#form-filter #role_id').val();
                    data.district_id = $('#form-filter #district_id').val();
                    data.upazila_id = $('#form-filter #upazila_id').val();
                    data.status = $('#form-filter #status').val();
                    data._token = _token;
                }
            },
            //array ar 0,2,11 index gulor sort off kora holo
            "columnDefs": [{
                    "targets": [0,2,11],
                    "orderable": false,
                    //"className": "text-center"
                },
                {
                   // "targets": [3, 6, 7, 8, 9],
                   // "className": "text-center"
                }
            ]       
    });
});

    //Data show after filtering
    $('#btn-filter').click(function () {
        table.ajax.reload();
    });

    //After reseting filter form reset
    $('#btn-reset').click(function () {
        $('#form-filter')[0].reset();
        table.ajax.reload();
    });

    $('.dropify').dropify();//Initialize dropify


    //store employee
    $(document).on('click', '.add_employee', function () {
        let storeForm = document.getElementById('storeForm');
        let formData = new FormData(storeForm);
        $.ajax({
        url: "{{route('employee.store')}}",
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType: false,
        processData: false,
        cache: false,
        success: function (data) {
            flashMessage(data.status, data.message);
            if (data.status == 'success') {
                $('#addEmployeeModal').modal('hide');
                $('#storeForm')[0].reset(); //form data clear
                $('.dropify-clear').trigger('click'); //image clear
                table.ajax.reload();
            }
        }
    });
			
});

//employee edit->table resposive true korle jquery selector kaj kore na
$(document).on('click', '.edit_data', function () {
        let _token = "{{csrf_token()}}";
        let id = $(this).data('id');
        if (id) {
            $.ajax({
                url: "{{route('employee.edit')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#editForm #update_id').val(data.user.id);
                    $('#editForm #name').val(data.user.name);
                    $('#editForm #email').val(data.user.email);
                    $('#editForm #mobile_no').val(data.user.mobile_no);
                    $('#editForm #district_id').val(data.user.district_id);
                    //ajax request theke data ante aktu somoy lage 
                    upazilaList(data.user.district_id,'editForm');
                    //ty 1 sec pore value ta set kore dea hoy
                    setTimeout(() => {
                        $('#editForm #upazila_id').val(data.user.upazila_id);//selected upazila show korbe
                    }, 1000);
                    
                    $('#editForm #postal_code').val(data.user.postal_code);
                    $('#editForm #address').val(data.user.address);
                    $('#editForm #role_id').val(data.user.role_id);
                    //image show
                    if (data.user.avatar) {
                        let avatar = "{{asset('storage/'.USER_AVATAR)}}/" + data.user.avatar;
                        $('#editForm .dropify-preview').css('display', 'block');
                        $('#editForm .dropify-render').html('<image src="' + avatar + '"/>');
                        $('#editForm #old_avatar').val(data.user.avatar);
                    }


                }
            });
        }
    });


//update employee
$(document).on('click', '.edit_employee', function () {
    let editForm = document.getElementById('editForm');
    let formData = new FormData(editForm);
    let id = $('#update_id').val();
    $.ajax({
    url: "{{route('employee.update')}}",
    type: "POST",
    data: formData,
    dataType: "JSON",
    contentType: false,
    processData: false,
    cache: false,
    success: function (data) {
        flashMessage(data.status, data.message);
        if (data.status == 'success') {
            $('#editEmployeeModal').modal('hide');
            table.ajax.reload(null, false);
        }
    },
    error: function (xhr, ajaxOption, thrownError) {
        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
    }
});
        
});

//view
$(document).on('click', '.view_data', function () {
        let id = $(this).data('id');
        let _token = "{{csrf_token()}}";
        if (id) {
            $.ajax({
                url: "{{route('employee.show')}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#view_data').html('');
                    $('#view_data').html(data.user_view);
                    $('#viewDataModal .modal-title').html('<i class="fas fa-eye"></i> <span> ' +
                        data.name + ' Details</span>');

                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }
    });

//delete using done and fail method
    $(document).on('click', '.delete_data', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let _token = "{{csrf_token()}}";
        let row = table.row($(this).parent('tr'));
        Swal.fire({
            title: 'Are you sure to delete ' + name,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ route('employee.delete') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    dataType: "JSON",
                }).done(function (response) {
                    if (response.status == "success") {
                        Swal.fire("Deleted", response.message, "success").then(function () {
                            table.row(row).remove().draw(false);
                        });
                    }
                }).fail(function () {
                    swal.fire('Oops...', "Somthing went wrong with ajax!", "error");
                });
            }
        });
    });

//flash msg function
function flashMessage(status, message) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        switch (status) {
            case 'success':
                toastr.success(message, 'SUCCESS');
                break;
            case 'error':
                toastr.error(message, 'ERROR');
                break;
            case 'info':
                toastr.info(message, 'INFORMARTION');
                break;
            case 'warning':
                toastr.warning(message, 'WARNING');
                break;
        }
    }

    // upazila shows under district
    function upazilaList(district_id, form) {
        if (district_id) {
            let _token = "{{csrf_token()}}";
            $.ajax({
                url: "{{route('employee.upazila.list')}}",
                type: "POST",
                data: {
                    district_id: district_id,
                    _token: _token
                },
                dataType: "JSON",
                success: function (data) {
                    $('#' + form + ' #upazila_id').html('');
                    $('#' + form + ' #upazila_id').html(data);
                }
            });
        }
    }

</script>

</body>
</html>