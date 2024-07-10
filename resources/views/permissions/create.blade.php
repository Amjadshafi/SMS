@extends('layouts.app-master')
@section('pageTitle', 'Permissions')
@section('content')
    <div class="bg-light p-4 rounded">
        <h2>{{ __("trans.Add new permission") }}</h2>
        <div class="lead">
           
        </div>

        <div class="container mt-4">

            <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">{{__("trans.Name") }}</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left" required>{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">{{ __("trans.Save Permssion")}}</button>
                <a href="{{ route('permissions.index') }}" class="btn btn-default">{{ __("trans.Back")}}</a>
            </form>
        </div>

    </div>
@endsection