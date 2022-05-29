@extends('layouts.layout')

@section('css')


@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h4>Add New Employee</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- Add Employee Form :: START -->
<form id="add_employee_form" action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company:</strong>
                <select class="form-control" name="company_id" id="company_id">
                    @foreach($companies as $key=>$company)
                    <option value="{{ $key }}">{{ $company }}</option>
                    @endforeach
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
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <input type="submit" class="btn btn-success w-25" value="Save">
        </div>
    </div>

</form>
<!-- Add Employee Form :: END -->
@endsection

@section('script')
<script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/additional-methods.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {

    // Validation for Employee add
    $("#add_employee_form").validate({
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

});
</script>
@endsection