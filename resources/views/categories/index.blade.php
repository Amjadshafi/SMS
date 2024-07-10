@extends('layouts.app-master')
@section('pageTitle', __('trans.All Category'))
@section('content')

<div class="mt-2">
    @include('layouts.partials.messages')
</div>
<div class="card ml-1 mr-1">
    <div class="card-header">
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right">{{ __("trans.AddNew") }}</a>
    </div>
    <div class="card-body">
        <table id="data-table" class="table display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>{{ __("trans.ID #") }}</th>
                    <th>{{ __("trans.Name") }}</th>
                    <th>{{ __("trans.Description") }}</th>
                    <th>{{ __("trans.Actions") }}</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>{{ __("trans.ID #") }}</th>
                    <th>{{ __("trans.Name") }}</th>
                    <th>{{ __("trans.Description") }}</th>
                    <th>{{ __("trans.Actions") }}</th>
                </tr>
            </tfoot>

            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a title="Show" href="{{ route('categories.show', $category->id) }}"><i class="mdi mdi-eye-outline"></i></a>
                        <a title="Edit" href="{{ route('categories.edit', $category->id) }}"><i class="mdi mdi-square-edit-outline"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection