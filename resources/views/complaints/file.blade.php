@extends('layouts.app-master')

@section('pageTitle', __("trans.Complaint Files"))
@section('content')
<div class="card ml-1 mr-1">
  <div class="card-body">
    <table id="data-table" class="table display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Complaint Name")}}</th>
          <th>{{ __("trans.Accused Name")}}</th>
          <th>{{ __("trans.Complaint")}}</th>
          <th>{{ __("trans.Organizations")}}</th>
          <th>{{ __("trans.File")}}</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
        <th>#</th>
          <th>{{ __("trans.Complaint Name")}}</th>
          <th>{{ __("trans.Accused Name")}}</th>
          <th>{{ __("trans.Complaint")}}</th>
          <th>{{ __("trans.Organizations")}}</th>
          <th>{{ __("trans.File")}}</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach($complaints as $complaint)
        <tr>
          <th>{{ $complaint->id }}</th>
          <td>{{ $complaint->complaint_fname }}</td>
          <td>{{ $complaint->accused_name }}</td>
          <td>{{ $complaint->complaint_body }}</td>
          <td>{{ $complaint->organization ? $complaint->organization->name : 'N/A' }}</td>
          <td>
            @foreach($complaint->complaint_files as $file)
            <a href="{{ asset('public/'.$file->file_location.'/'.$file->name)}}" target="_blank"><i class="mdi mdi-file-pdf"></i></a>
            @endforeach
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
