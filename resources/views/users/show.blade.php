@extends('layouts.app-master')
@section('pageTitle',__("trans.User"). ' ' .__("trans.Profile"))
@section('content')
<div class="card ml-1 mr-1">
  <div class="card-header">
  </div>
  <div class="card-body">
  <div class="bg-light p-4 rounded">        
        <div class="container mt-4">
            <div>
           <b> {{ __("trans.Name")}}</b>: {{ $user->name }} 
            </div>
            <div>
            <b>{{ __("trans.Email")}}</b>: {{ $user->email }}
            </div>
            <div>
            <b>{{ __("trans.Username")}}</b>: {{ $user->username }}
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">{{ __("trans.Edit")}}</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">{{ __("trans.Back")}}</a>
    </div>
  </div>
</div>
@endsection