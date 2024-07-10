@extends('layouts.app-master')
@section('pageTitle', __("trans.Users"))
@section('content')
<div class="card ml-1 mr-1">
  <div class="card-header">
    @auth
    @role(['Super Admin','Admin'])
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">{{ __("trans.AddNew")}}</a>
    @endrole
    @endauth
  </div>
  <div class="card-body">
    <table id="data-table" class="table display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Name")}}</th>
          <th>{{ __("trans.Email")}}</th>
          <th>{{ __("trans.Username")}}</th>
          <th>{{ __("trans.Role")}}</th>
          <th>{{ __("trans.Actions")}}</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Name")}}</th>
          <th>{{ __("trans.Email")}}</th>
          <th>{{ __("trans.Username")}}</th>
          <th>{{ __("trans.Role")}}</th>
          <th>{{ __("trans.Actions")}}</th>
        </tr>
      </tfoot>

      <tbody>
        @if(Auth::check())
        <tr>
          <td>{{ Auth::user()->id }}</td>
          <td>{{ Auth::user()->name }}</td>
          <td>{{ Auth::user()->email }}</td>
          <td>{{ Auth::user()->username }}</td>
          <td>
            @foreach(Auth::user()->roles as $role)
            <span class="badge bg-light">{{ $role->name }}</span>
            @endforeach
          </td>
          <td>
            <a title="Show" href="{{ route('users.show', Auth::user()->id) }}"><i class="mdi mdi-eye-outline"></i></a>
            <a title="Edit" href="{{ route('users.edit', Auth::user()->id) }}"><i class="mdi mdi-square-edit-outline"></i></a>
          </td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection


