@extends('layouts.layout')


@section('css')

@endsection


@section('content')


<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h2>Company List</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('home') }}"> Home</a>
            <a class="btn btn-info" href="{{ route('employee.index') }}"> Employee</a>
            <a class="btn btn-success" href="{{ route('companies.add') }}"> Add Company</a>
        </div>
    </div>
</div>
<!-- table for company list -->
<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Logo</th>
            <th>Email</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- company delete confirmation alert popup::START -->
<div class="modal fade" id="deleteCompanyAlertModel" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this company? If you remove this company, then all company details will be removed. It's not revertable.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                <a href="#" id="deleteLink" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<!-- company delete confirmation alert popup::END -->

<!-- company edit popup::START -->
<div class="modal fade" id="editCompanyAlertModel" tabindex="-1" role="dialog" aria-labelledby="companyEditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update_company" name="update_company" method="post" enctype="multipart/form-data">
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
                                <strong>Name:</strong>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Company Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Company Email">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Logo:</strong>
                                <input name="logo" id="logo" type="file" title="Company Logo" accept="image/*" onchange="loadFile(event)">

                                <img id="output" src='{{ asset('assets/default/default.png') }}' class="" height="100px" width="100px" alt="Company Logo">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Website:</strong>
                                <input type="text" name="website" id="website" class="form-control" placeholder="Company Website">
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
<!-- company delete confirmation alert popup::END -->
@endsection

@section('script')
<script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/additional-methods.min.js') }}"></script>
<script>
    // start::Image File Preview
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);

        const file = event.target.files[0];
        const  fileType = file['type'];
        const validImageTypes = ['image/jpg', 'image/jpeg', 'image/png'];
        console.log(fileType);
        if (validImageTypes.includes(fileType)) {
            // invalid file type code goes here.
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        } else {
            $("#output").attr('src', "{{ config('constants.defaultImage.default') }}");
        }
    };
    // end::Image File Preview
</script>
<script type="text/javascript">
    $(function () {

        // Load company data in datatable using ajax
        var table = $('.data-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ route('companies.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {
                    data: 'logo_full_path', name: 'logo_full_path',
                    render: function (data, type, full, meta) {
                        return '<img src="' + data + '" height="34">';
                    }
                },
                {data: 'email', name: 'email'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
            ],
            "order": [
                [5, "desc"]
            ],
            "columnDefs": [{
                    "targets": [0],
                    "searchable": true,
                    "bSortable": false
                },
                {
                    "targets": [1],
                    "searchable": true,
                    "bSortable": true
                },
                {
                    "targets": [2],
                    "searchable": false,
                    "bSortable": false
                },
                {
                    "targets": [3],
                    "searchable": true,
                    "bSortable": true
                },
                {
                    "targets": [4],
                    "searchable": true,
                    "bSortable": false
                },
                {
                    "targets": [5],
                    "searchable": false,
                    "visible": false
                }
            ],
        });
        
        // show company delete alert popup
        $(document).on('click', 'a.button_copmany_delete', function () {
            var url = $(this).data('url');
            $("#deleteCompanyAlertModel").modal("show");
            $("#deleteLink").attr("href", url);
        });

        // show company edit alert popup
        $(document).on('click', 'a.button_copmany_edit', function () {
            var editFromData = $(this).data('edit');
            $("#editCompanyAlertModel").modal("show");
            $("#name").val(editFromData.name);
            $("#email").val(editFromData.email);
            $("#output").attr("src",editFromData.logo_full_path);
            $("#website").val(editFromData.website);

            var editFormURL = '{{ route("companies.update", ":company") }}';
            editFormURL = editFormURL.replace(':company', editFromData.id);
            $("#update_company").attr('action', editFormURL);
        });

        // validation for update company
        var validator = $("#update_company").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                logo: {
                    extension: "jpg,jpeg,png",
                },
                website: {
                    url: true
                }
            },
            messages: {
                name: {
                    required: "Please enter company name",
                },
                email: {
                    required: "Please enter company email",
                },
                logo: {
                    extension: "Please select JPG,JPEG,PNG format file",
                },
                website: {
                    required: "Please enter company website url",
                }
            }

        });
        
        // reset company edit form
        $("#configreset").click(function() {
            validator.resetForm();
        });
    });
</script>
@endsection