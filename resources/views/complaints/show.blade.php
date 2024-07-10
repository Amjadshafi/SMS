@extends('layouts.app-master')

@section('pageTitle', __("trans.Complaint Details"))

@section('content')
<div class="card">
    <div class="card">
        <div class="card-header text-center">
            <h3 class="mb-0">{{ __("trans.Detailed Complaint Information") }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{ __("trans.Applicant Information") }}</h3>
                    <p><strong>{{ __("trans.Complaint Name") }}:</strong> {{ $complaint->complaint_fname }}</p>
                    <p><strong>{{ __("trans.Complaint Email") }}:</strong> {{ $complaint->complaint_email }}</p>
                    <p><strong>{{ __("trans.Complaint Phone No") }}:</strong> {{ $complaint->complaint_phone_no }}</p>
                    <p><strong>{{ __("trans.Complaint Address") }}:</strong> {{ $complaint->complaint_address }}</p>
                    <p><strong>{{ __("trans.Organizations") }}:</strong> {{ $complaint->organization->name }}</p>

                </div>
                <div class="col-md-6">
                    <h3>{{ __("trans.Accused Information") }}</h3>
                    <p><strong>{{ __("trans.Accused Name") }}:</strong> {{ $complaint->accused_name }}</p>
                    <p><strong>{{ __("trans.Accused Email") }}:</strong> {{ $complaint->accused_email }}</p>
                    <p><strong>{{ __("trans.Accused Phone No.") }}:</strong> {{ $complaint->accused_phone_no }}</p>
                    <p><strong>{{ __("trans.Accused City") }}:</strong> {{ $complaint->accused_city}}</p>
                    <p><strong>{{ __("trans.Accused Country") }}:</strong> {{ $complaint->accused_country }}</p>
                    <p><strong>{{ __("trans.Accident Place") }}:</strong> {{ $complaint->accident_place }}</p>
                    <p><strong>{{ __("trans.Accidental Evidence") }}:<br>
                            @foreach($complaint->complaint_files as $file)
                            <a href="{{ asset('public/'.$file->file_location.'/'.$file->name)}}" target="_blank">
                                <i class="mdi mdi-file-pdf" style="font-size: 28px;"></i>
                            </a>
                            @endforeach
                </div>
            </div>
            <div class="mt-3">
                <strong>{{ __("trans.Complaint") }}:</strong>
                <p>{{ $complaint->complaint_body }}</p>
            </div>
            <br>
            <div class="mt-4">
                <a href="{{ route('complaint.index') }}" class="btn btn-primary">{{ __("trans.Back to Complaints") }}</a>
            </div>
        </div>
    </div>
</div>
@endsection