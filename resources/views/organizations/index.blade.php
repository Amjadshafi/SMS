@extends('layouts.app-master')
@section('pageTitle',__('trans.All Oganizations'))
@section('content')

<div class="mt-2">
    @include('layouts.partials.messages')
</div>
<div class="card ml-1 mr-1">
    <div class="card-header">
        <a href="{{ route('createOrganizationForm') }}" class="btn btn-primary btn-sm float-right">{{ __("trans.AddNew")}}</a>
    </div>
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __("trans.ID #")}}</th>
                    <th>{{ __("trans.Name")}}</th>
                    <th>{{ __("trans.Email")}}</th>
                    <th>{{ __("trans.Actions")}}</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>{{ __("trans.ID #")}}</th>
                    <th>{{ __("trans.Name")}}</th>
                    <th>{{ __("trans.Email")}}</th>
                    <th>{{ __("trans.Actions")}}</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($organizations as $key => $organization)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->email }}</td>
                    <td>
                        <a title="Show" href="{{ route('organizations.show', $organization->id) }}"><i class="mdi mdi-eye-outline"></i></a>
                        <a title="Edit" href="{{ route('organizations.edit', $organization->id) }}"><i class="mdi mdi-square-edit-outline"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection