@extends('layouts.app-master')
@section('pageTitle', __("trans.Update") .' ' .__("trans.Users"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
        <div class="card-body">
            <div class="tab-content mt-5" id="nav-tabContent">
                @if(!(auth()->user()->hasRole(['Super Admin'])))
                <div class="tab-pane fade" id="security_tab" role="tabpanel" aria-labelledby="security_tab">
                    <form method="post" action="{{ route('users.updatePassword', $user->id) }}">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="username">{{ __("trans.Username")}}</label>
                            <input value="{{ $user->username }}" type="text" class="form-control" name="username" placeholder='{{ __("trans.Username")}}' required>
                            @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __("trans.New Password")}}</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('trans.New Password')}}">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">{{ __("trans.Confirm Password")}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ __('trans.Confirm Password')}}">
                        </div>
                        <div class="form-group">
                            <label for="old_password">{{ __("trans.old Password")}}</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{ __('trans.old Password')}}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __("trans.Update")}}</button>
                            <a href="" class="btn btn-secondary">{{ __("trans.Cancel")}}</a>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection