@extends('layouts.app-master')
@section('pageTitle',__('trans.All Committees'))
@section('content')

<div class="mt-2">
    @include('layouts.partials.messages')
</div>
<div class="card ml-1 mr-1">
    <div class="card-header">
        <a href="{{ route('committee.create') }}" class="btn btn-primary btn-sm float-right">{{ __("trans.AddNew")}}</a>
    </div>
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __("trans.ID #")}}</th>
                    <th>{{ __("trans.Name")}}</th>
                    <th>Members</th>
                    <th>{{ __("trans.Actions")}}</th>
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>{{ __("trans.ID #")}}</th>
                    <th>{{ __("trans.Name")}}</th>
                    <th>Members</th>
                    <th>{{ __("trans.Actions")}}</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach ($committees as $key => $committee)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $committee->name }}</td>
                    <td>
                        <ul>
                        @foreach($committee->users as $user)
                            <li>{{$user->name}}</li>
                        
                        @endforeach
                        </ul>
                    </td>
                    <td>
                        <a title="Show" href="{{ route('committee.show', $committee->id) }}"><i class="mdi mdi-eye-outline"></i></a>
                        <a title="Edit" href="{{ route('committee.edit', $committee->id) }}"><i class="mdi mdi-square-edit-outline"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection