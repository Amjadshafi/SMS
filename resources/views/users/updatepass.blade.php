@extends('layouts.app-master')
@section('pageTitle', __("trans.Update") .' ' .__("trans.Users"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="tab-content mt-5" id="nav-tabContent">
            @if(auth()->user()->hasRole('Super Admin'))
            <div class="tab-pane fade" id="test" role="tabpanel" aria-labelledby="test-tab">
                <form method="post" action="{{ route('users.adminpassword', $user->id) }}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __("trans.Username")}}</label>
                        <input value="{{ $user->username }}" type="text" class="form-control" name="username" placeholder='{{ __("trans.Username")}}' required>
                        @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __("trans.New Password")}}</label>
                        <input type="password" class="form-control" name="password" placeholder="{{ __('trans.New Password')}}">
                        @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __("trans.Confirm Password")}}</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('trans.Confirm Password')}}">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">{{ __("trans.Update")}}</button>
                        <a href="" class="btn btn-secondary">{{ __("trans.Cancel")}}</a>
                    </div>
                </form>
            </div>
            @endif