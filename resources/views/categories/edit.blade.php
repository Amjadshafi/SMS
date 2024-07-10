@extends('layouts.app-master')
@section('pageTitle', __("trans.Edit Category"))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-8">
        <h2 class="text-center mb-4">{{ __("trans.Edit Category") }}</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{ __("trans.Category Name") }}</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>
            <div class="form-group">
                <label for="description" class="text-center mb-4">{{ __("trans.Description") }}</label>
                <input type="text" name="description" class="form-control" value="{{ $category->description }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __("trans.Update") }}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection
