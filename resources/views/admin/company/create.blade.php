@extends('layouts.layout')

@section('css')


@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h4>Add New Company</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger p-5">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Company Form :: START -->
<form id="add_company_form" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

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
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <input type="submit" class="btn btn-success w-25" value="Save">
        </div>
    </div>

</form>
<!-- Company Form :: END -->
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
$(document).ready(function () {

    // Validation for company add
    $("#add_company_form").validate({
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
            },
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
            },
        },
    });

});
</script>
@endsection