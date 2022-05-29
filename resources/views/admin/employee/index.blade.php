@extends('layouts.layout')


@section('css')

@endsection


@section('content')


<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h2>Employee List</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('home') }}"> Home</a>
            <a class="btn btn-info" href="{{ route('companies.index') }}"> Company</a>
            <a class="btn btn-success" href="{{ route('employee.add') }}"> Add Employee</a>
        </div>
    </div>
</div>
<!-- Table for employee listing::START -->
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- Table for employee listing::END -->

<!-- employee delete confirmation alert popup::START -->
<div class="modal fade" id="deleteEmployeeAlertModel" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this employee? If you remove this employee, then all employee details will be removed. It's not revertable.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <a href="#" id="deleteLink" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- employee delete confirmation alert popup::END -->

<!-- employee edit popup::START -->
<div class="modal fade" id="editEmployeeAlertModel" tabindex="-1" role="dialog" aria-labelledby="employeeEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update_employee" name="update_employee" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="companyEditModalLabel">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Company:</strong>
                                <select class="form-control" name="company_id" id="company_id">
                                    @if(count($companies) > 0)
                                        @foreach($companies as $key=>$company)
                                        <option value="{{ $key }}">{{ $company }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>First Name:</strong>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Employee First Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Last Name:</strong>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Employee Last Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Employee Email">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Employee Phone">         
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="reset" id="configreset" class="btn btn-info" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- employee delete confirmation alert popup::END -->
@endsection



@section('script')
<script type="text/javascript">
    $(function () {

        // Load employee data table using ajax
        var table = $('.data-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('employee.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'full_name', name: 'full_name'},
                {data: 'company.name', name: 'company.name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
            ],
            "order": [
                [6, "desc"]
            ],
            "columnDefs": [{
                    "targets": [0], // auto incremented id
                    "searchable": false,
                    "bSortable": false
                },
                {
                    "targets": [1], // full name
                    "searchable": true,
                    "bSortable": true
                },
                {
                    "targets": [2], // copmany name
                    "searchable": true,
                    "bSortable": true
                },
                {
                    "targets": [3], // email
                    "searchable": true,
                    "bSortable": false
                },
                {
                    "targets": [4], //phone
                    "searchable": true,
                    "bSortable": false
                },
                {
                    "targets": [5], // action
                    "searchable": true,
                    "bSortable": false
                },
                {
                    "targets": [6], // hidden id
                    "searchable": false,
                    "visible": false
                }
            ],
        });

        // Show delete alert popup of employee
        $(document).on('click', 'a.button_employee_delete', function () {
            var url = $(this).data('url');
            $("#deleteEmployeeAlertModel").modal("show");
            $("#deleteLink").attr("href", url);
        });

        // Show edit alert popup of employee
        $(document).on('click', 'a.button_employee_edit', function () {
            var editFromData = $(this).data('edit');
            
            $("#editEmployeeAlertModel").modal("show");
            $("#first_name").val(editFromData.first_name);
            $("#last_name").val(editFromData.last_name);
            $("#email").val(editFromData.email);
            $("#phone").val(editFromData.phone);
            $("#company_id").val(editFromData.company_id);
            var editFormURL = '{{ route("employee.update", ":employee") }}';
            editFormURL = editFormURL.replace(':employee', editFromData.id);
            $("#update_employee").attr('action', editFormURL);
        });

        // Validation for employee
        var validator = $("#update_employee").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                email: true,
            },
            phone: {
                number: true,
                maxlength: 10                
            },
        },
        messages: {
            first_name: {
                required: "Please enter first name",
            },
            last_name: {
                required: "Please enter last name",
            },
            email: {
                email: "Please enter valid email",
            },
            phone: {
                number: "Please enter numbers only",
            },
        },
    });
    
        // Reset employee form while clicking on reset button
        $("#configreset").click(function() {
            validator.resetForm();
        });

    });
</script>
@endsection