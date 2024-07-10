@extends('layouts.app-master')
@section('pageTitle', __("trans.All Complaints"))
@section('content')
<div class="card ml-1 mr-1">
  <div class="card-body">

    <div style="text-align:right">
    <a href="{{ route('complaint.generatePDF') }}" class="btn btn-primary">{{ __("trans.Download PDF")}}</a>
      <a href="{{route('createComplaint')}}" class="btn btn-primary">{{ __("trans.Create New Complaint")}} </a>
    </div>
    <table id="data-table" class="table display" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Complaint Firstname")}}</th>
          <th>{{ __("trans.Complaint ID")}}</th>
          <th>{{ __("trans.Complaint Email")}}</th>
          <th>{{ __("trans.Complaint Phone No")}}</th>
          <th>{{ __("trans.Accused Name")}}</th>
          <th>{{ __("trans.Accused Email")}}</th>
          <th>{{ __("trans.Accused Phone No.")}}</th>
          <th>{{ __("trans.Complaint")}}</th>
          <th>{{ __("trans.Organizations")}}</th>
          <th>{{ __("trans.File")}}</th>
          <th>{{ __("trans.Current Status")}}</th>
          <th>{{ __("trans.Actions")}}</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <th>#</th>
          <th>{{ __("trans.Complaint Firstname")}}</th>
          <th>{{ __("trans.Complaint ID")}}</th>
          <th>{{ __("trans.Complaint Email")}}</th>
          <th>{{ __("trans.Complaint Phone No")}}</th>
          <th>{{ __("trans.Accused Name")}}</th>
          <th>{{ __("trans.Accused Email")}}</th>
          <th>{{ __("trans.Accused Phone No.")}}</th>
          <th>{{ __("trans.Complaint")}}</th>
          <th>{{ __("trans.Organizations")}}</th>
          <th>{{ __("trans.File")}}</th>
          <th>{{ __("trans.Current Status")}}</th>
          <th>{{ __("trans.Actions")}}</th>
        </tr>
      </tfoot>

      <tbody>
        @foreach($complaints as $key => $value)
        <tr>
          <th>{{ ++$key }}</th>
          <td>{{ $value->complaint_fname }}</td>
          <td>{{'CA-'.padNumber($value->id)}}</td>
          <td>{{ $value->complaint_email }}</td>
          <td>{{ $value->complaint_phone_no }}</td>
          <td>{{ $value->accused_name }}</td>
          <td>{{ $value->accused_email }}</td>
          <td>{{ $value->accused_phone_no }}</td>
          <td>{{ $value->complaint_body }}</td>
          <td>{{ $value->organization ? $value->organization->name : 'N/A' }}</td>
          <td>
            @auth
            @role(['Super Admin','Admin'])
            @foreach($value->complaint_files as $file)
            <a href="{{ asset('public/'.$file->file_location.'/'.$file->name)}}" target="_blank"><i class="mdi mdi-file-pdf"></i></a>
            @endforeach
            @endrole
            @endauth
          </td>
          <?php
          $status = "Pending";
          if ($value->status == 1)
            $status = "In Process";
          else if ($value->status == 2)
            $status = "Canceled";
          else if ($value->status == 3)
            $status = "Completed";
          ?>
          <td>{{ $status }}</td>
          <td>
            <a data-toggle="modal" data-id="{{ $value->id }}" title="Add this item" class="editModal" href="#edit-complaint-modal"><i class="mdi mdi-square-edit-outline"></i></a>
            <a title="Show" href="{{ route('complaints.show', $value->id) }}"><i class="mdi mdi-eye-outline"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Form Modal -->
<div class="modal fade" id="edit-complaint-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle">{{ __("trans.Assigned To")}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{route('update.complaint')}}">
        <div class="modal-body">

          @csrf
          <input type="hidden" name="complaint_id" value="" id="complaint_id">
          <div class="form-group">
            <label for="status">{{ __("trans.Status")}}</label>
            <select name="status" id="status" class="form-control" require>
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">{{ __("trans.Assigned To")}}</label>
            <select name="assigned_to" id="assigned_to" class="form-control" require>

            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">{{ __("trans.Close")}}</button>
          <button type="submit" class="btn btn-primary btn-pill">{{ __("trans.Save Changes")}}</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
  $(document).on('click', ".editModal", function() {
    var complaintId = $(this).data('id');
    $("#complaint_id").val(complaintId);

    $.ajax({
      type: "POST",
      url: "{{route('getComplaintData')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        id: complaintId
      },
      success: function(data) {
        var res = JSON.parse(data);
        $("#status").empty();
        $("#assigned_to").empty();

        $("#status").append(res.status);
        $("#assigned_to").append(res.assigned_to);
      }
    });

  });
</script>


@endsection