@extends('layouts.app-master')
@section('pageTitle', __("trans.Update") .' ' .__("trans.Users"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#general_tab" role="tab" aria-controls="general_tab" aria-selected="true">General</a>
            </li>
            @if(!(auth()->user()->hasRole(['Super Admin'])))
            <li class="nav-item">
                <a class="nav-link" id="nav-profile-tab" data-toggle="pill" href="#security_tab" role="tab" aria-controls="security_tab" aria-selected="false">Security</a>
            </li>
            @endif
            @if(auth()->user()->hasRole(['Super Admin']))
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#test" role="tab" aria-controls="test" aria-selected="false">Security</a>
            </li>
            @endif
        </ul>
        <div class="tab-content mt-5" id="nav-tabContent">
            @if(auth()->user()->hasRole(['Super Admin']))
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
            <div class="tab-pane fade show active" id="general_tab" role="tabpanel" aria-labelledby="general_tab">
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __("trans.Name")}}</label>
                        <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder='{{ __("trans.Name")}}' required>
                        @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __("trans.Email")}}</label>
                        <input value="{{ $user->email }}" type="email" class="form-control" name="email" placeholder='{{ __("trans.Email Address")}}' required>
                        @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __("trans.Username")}}</label>
                        <input value="{{ $user->username }}" type="text" class="form-control" name="username" placeholder='{{ __("trans.Username")}}' required>
                        @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <!-- <div class="mb-3">
                        <label for="role" class="form-label">{{ __("trans.Language")}}</label>
                        <select class="form-control" name="lang" required>
                            <option value="">Select Language</option>
                            <option value="en">English</option>
                            <option value="gr">German</option>
                        </select>
                        @if ($errors->has('lang'))
                        <span class="text-danger text-left">{{ $errors->first('lang') }}</span>
                        @endif
                    </div> -->
                    @if(auth()->user()->hasRole(['Super Admin']))
                    <div class="form-group">
                        <label for="organization">{{ __("trans.Organization") }}</label>
                        <select class="form-control" id="organization" name="organization_id">
                            @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}" @if($user->organization_id == $organization->id) selected @endif>{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="role">{{ __("trans.Role") }}</label>
                        @if(auth()->user()->hasRole(['Super Admin']))
                        <select class="form-control" id="role" name="role">
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}" @if(in_array($role->name, $userRole)) selected @endif>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="text" class="form-control" value="{{ $user->roles->first()->name }}" disabled>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __("trans.Update")}}</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __("trans.Cancel")}}</a>
                </form>
            </div>
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
@endsection