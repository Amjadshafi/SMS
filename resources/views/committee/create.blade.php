@extends('layouts.app-master')
@section('pageTitle', __("trans.Add New Committee"))
@section('content')
<style>
    .form-group {
        margin-bottom: 20px;
    }

    h2 {
        margin-top: 20px;
        /* Adjust the value as needed */
    }
</style>
<div class="card ml-8 mr-8">
    <div class="form-group col-12">
        <h2 class="text-center mb-4">{{ __("trans.Committee Form")}}</h2>
        <form action="{{ route('committee.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{__("trans.Committee Name")}}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="organization_id">{{ __("trans.Organization")}}</label>
                <select name="organization_id" class="form-control" required>
                    <option value="">{{ __("trans.Select Organization")}}</option>
                    @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">{{ __("trans.Select Members") }}</label>
                <select name="user_id[]" id="user_id" class="select2-original" required multiple>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__("trans.Submit")}}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.select2-original').select2({
    	placeholder: "{{ __('trans.Choose Team Members')}}",
      width: "100%"
    });
</script>
@endsection