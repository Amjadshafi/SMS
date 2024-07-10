@extends('layouts.app-master')
@section('pageTitle',__("trans.Create"). ' ' .__("trans.User"))
@section('content')
<div class="card ml-1 mr-1">
    <div class="card-header">
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">{{ __("trans.Name")}}</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder='{{ __("trans.Name")}}' required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">{{ __("trans.Email")}}</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder='{{ __("trans.Email Address")}}' required>
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">{{ __("trans.Username")}}</label>
                <input value="{{ old('username') }}" type="text" class="form-control" name="username" placeholder='{{ __("trans.Username")}}' required>
                @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __("trans.Password")}}</label>
                <input type="password" class="form-control" name="password" placeholder='{{ __("trans.Password")}}' required>
                @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">{{ __("trans.Language")}}</label>
                <select class="form-control" name="lang" required>
                    <option value="">Select Language</option>
                    <option value="en">English</option>
                    <option value="gr">German</option>
                </select>
                @if ($errors->has('lang'))
                <span class="text-danger text-left">{{ $errors->first('lang') }}</span>
                @endif
            </div>
            <div class="mb-3">
                    <label class="form-label" for="organization_id">{{__('trans.Select the Organizaion')}}</label>
                    <select name="organization_id" id="organization_id" class="form-control form-control-md" required>
                        <option value="">{{__('trans.Select the Organizaion')}}</option>
                        @foreach($organizations as $org)
                        <option value="{{$org['id']}}">{{$org['name']}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">{{ __("trans.Role")}}</label>
                <select class="form-control" name="role" required>
                    <option value="">{{ __("trans.Select role")}}</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role'))
                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ __("trans.Submit")}}</button>
            <a href="{{ route('users.index') }}" class="btn btn-default">{{ __("trans.Back")}}</a>
        </form>
    </div>
</div>
@endsection