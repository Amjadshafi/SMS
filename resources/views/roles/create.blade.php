@extends('layouts.app-master')
@section('pageTitle',__("trans.Create"). ' ' .__("trans.Role"))
@section('content')

<div class="mt-2">
            @include('layouts.partials.messages')
        </div>
<div class="card ml-1 mr-1">
  <div class="card-body">
    @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __("trans.Name")}}</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder='{{ __("trans.Name")}}' required>
                </div>
                
                <label for="permissions" class="form-label">{{ __("trans.AssignPermissions")}}</label>

                <table class="table table-striped">
                    <thead>
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="20%">{{ __("trans.Name")}}</th>
                        <th scope="col" width="1%">{{ __("trans.Guard")}}</th> 
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" 
                                name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}"
                                class='permission'>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>

                <button type="submit" class="btn btn-primary">{{ __("trans.Save")}}</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">{{ __("trans.Back")}}</a>
            </form>
  </div>
</div>    
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
                
            });
        });
    </script>
@endsection