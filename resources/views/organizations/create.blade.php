@extends('layouts.app-master')
@section('pageTitle', __("trans.Add New Organizations"))
@section('content')
<style>
    .form-group {
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 20px; /* Adjust the value as needed */
    }
</style>
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Organizations Form")}}</h2>
        <form action="{{ route('storeOrganization') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{__("trans.Organization Name")}}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{__("trans.Head Of Organization Name")}}</label>
                <input type="text" name="head_of_oganization" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{__("trans.Email")}}</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone" class="text-center mb-4">{{__("trans.Phone No.")}}</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address" class="text-center mb-4">{{__("trans.Address")}}</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="zipcode" class="text-center mb-4">{{__("trans.Zip Code")}}</label>
                <input type="text" name="zipcode" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">{{__("trans.Submit")}}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection