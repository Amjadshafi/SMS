@extends('layouts.app-master')
@section('pageTitle', __("trans.Add New Category"))
@section('content')
<style>
    .form-group {
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 20px; 
    }
</style>
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Categories Form")}}</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{__("trans.Category Name")}}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description" class="text-center mb-4">{{__("trans.Description")}}</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">{{__("trans.Submit")}}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection