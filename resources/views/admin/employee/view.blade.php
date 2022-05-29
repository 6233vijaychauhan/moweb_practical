@extends('layouts.layout')

@section('css')


@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h4>View Employee Details</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employee.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>
</div>
<!-- Employee Form::START -->
<form enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company:</strong>
                <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Employee Company Name" value="{{ $employee->company->name }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Employee First Name" value="{{ $employee->first_name }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Employee Last Name" value="{{ $employee->last_name }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" id="email" class="form-control" placeholder="Employee Email" value="{{ $employee->email }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Employee Phone" value="{{ $employee->phone }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-info w-25" href="{{ route('employee.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>

</form>
<!-- Employee Form::END -->
@endsection

@section('script')

<script>
    $(document).ready(function () {

    });
</script>
@endsection