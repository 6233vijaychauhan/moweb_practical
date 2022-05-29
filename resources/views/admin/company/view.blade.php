@extends('layouts.layout')

@section('css')


@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 mt-2">
        <div class="pull-left">
            <h4>View Company Details</h4>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>
</div>
<!-- company form for view::START -->
<form id="view_company_form" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" id="name" class="form-control" placeholder="Company Name" value="{{ $company->name }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" id="email" class="form-control" placeholder="Company Email" value="{{ $company->email }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Logo:</strong>
                <img src='{{ $company->logo_full_path }}' class="" height="100px" width="100px" alt="User Profile">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Website:</strong>
                <input type="text" name="website" id="website" class="form-control" placeholder="Company Website" value="{{ $company->website }}" readonly="">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <a class="btn btn-info w-25" href="{{ route('companies.index') }}">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                Back
            </a>
        </div>
    </div>

</form>
<!-- company form for view::END -->
@endsection

@section('script')

<script>
$(document).ready(function () {
    
});
</script>
@endsection