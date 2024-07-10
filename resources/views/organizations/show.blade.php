@extends('layouts.app-master')
@section('pageTitle', __('trans.Organization Details'))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Organization Details") }}</h2>
        <div class="form-group">
            <label class="text-center mb-2">{{ __("trans.Organization Name") }}:</label>
            <p>{{ $organization->name }}</p>
        </div>
        <div class="form-group">
            <label class="text-center mb-2">{{ __("trans.Email") }}:</label>
            <p>{{ $organization->email }}</p>
        </div>
        <div class="form-group">
        <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Back")}}</a>
            
        </div>
    </div>
</div>
@endsection