@extends('layouts.app-master')
@section('pageTitle', __("trans.Edit Organization"))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Edit Organization") }}</h2>
        <form action="{{ route('organizations.update', $organization->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{ __("trans.Organization Name") }}</label>
                <input type="text" name="name" class="form-control" value="{{ $organization->name }}" required>
            </div>
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{ __("trans.Email") }}</label>
                <input type="text" name="email" class="form-control" value="{{ $organization->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __("trans.Update") }}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection