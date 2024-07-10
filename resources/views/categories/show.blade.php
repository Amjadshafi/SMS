@extends('layouts.app-master')
@section('pageTitle', __('trans.Categories Details'))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Categories Details") }}</h2>
        <div class="form-group">
            <label class="text-center mb-2">{{ __("trans.Category Name") }}:</label>
            <p>{{ $category->name }}</p>
        </div>
        <div class="form-group">
            <label class="text-center mb-2">{{ __("trans.Description") }}:</label>
            <p>{{ $category->description }}</p>
        </div>
        <div class="form-group">
        <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Back")}}</a>
            
        </div>
    </div>
</div>
@endsection