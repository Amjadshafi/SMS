@extends('layouts.app-master')
@section('pageTitle', __("trans.Edit Committee"))
@section('content')
<div class="card ml-8 mr-8">
    <div class="form-group col-10">
        <h2 class="text-center mb-4">{{ __("trans.Edit Committee") }}</h2>
        <form action="{{ route('committee.update', $committee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name" class="text-center mb-4">{{ __("trans.Comittee Name") }}</label>
                <input type="text" name="name" class="form-control" value="{{ $committee->name }}" required>
            </div>
            <div class="form-group">
                <label for="organization_id" class="text-center mb-4">{{ __("trans.Organization") }}</label>
                <select name="organization_id" class="form-control" required>
                    @foreach($organizations as $organization)
                        <option value="{{ $organization->id }}" {{ $committee->organization_id == $organization->id ? 'selected' : '' }}>
                            {{ $organization->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">{{ __("trans.Update") }}</button>
            <a href="{{ url()->previous() }}" type="button" class="btn tumblr">{{ __("trans.Cancel")}}</a>
        </form>
    </div>
</div>
@endsection
