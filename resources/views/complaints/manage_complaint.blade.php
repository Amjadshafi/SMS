@extends('layouts.app-master')
@section('pageTitle', __("trans.Complaint List"))
@section('content')

<HEAD>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</HEAD>
<div class="card ml-1 mr-1">
  <br>
  <div class="row">
    <div class="col-md-6">
      <button><a href="{{ route('createComplaint') }}" class="btn btn-primary">{{ __("trans.AddNew")}}</a></button>
    </div>
    <div class="col-md-6">
      <h3>{{ __("trans.Complaint List")}}</h3>
    </div>
  </div>
  <br>

  <table id="data-table" class="table display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>#</th>
        <th>{{ __("trans.Complaint Name")}}</th>
        <th>{{ __("trans.Accused Name")}}</th>
        <th>{{ __("trans.Complaint ID")}}</th>
        <th>{{ __("trans.Complaint")}}</th>
        <th>{{ __("trans.Organizations")}}</th>
        <th>{{ __("trans.File")}}</th>
        <th>{{ __("trans.Current Status")}}</th>
        <th>{{ __("trans.Assigned To") }}</th>
        <th>{{ __("trans.Update Status")}}</th>
        <th>{{ __("trans.Update Complaint")}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($complaints as $key =>$value)
      <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $value->complaint_fname }}</td>
        <td>{{ $value->accused_name }}</td>
        <td>{{'CA-'.padNumber($value->id)}}</td>
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
        <td>{{ $value->assigned_to_user ? $value->assigned_to_user->name : '' }}</td>
        <td>
          <a data-toggle="modal" data-id="{{ $value->id }}" title="Status Update" class="editModal btn btn-sm btn-outline-secondary" href="#edit-status-modal">Status Update</a>
        </td>
        <td>
          <a data-toggle="modal" data-id="{{ $value->id }}" title="Edit Complaint" class="edit-complaint" href="#edit-complaint-modal"><i class="mdi mdi-square-edit-outline"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

<!-- Form Modal -->
<div class="modal fade" id="edit-status-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
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

<div class="modal fade" id="edit-complaint-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalFormTitle">Edit Complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="border p-6">
          <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#complaint-tab" role="tab" aria-controls="nav-tabs" aria-selected="true">Complaint</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-profile-tab" data-toggle="pill" href="#attachment-file-tab" role="tab" aria-controls="nav-profile" aria-selected="false">Attachment File</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-profile-tab" data-toggle="pill" href="#comment-tab" role="tab" aria-controls="nav-profile" aria-selected="false">Comments</a>
            </li>
          </ul>
          <div class="tab-content mt-5" id="nav-tabContent" width="100%">
            <div class="tab-pane fade show active" id="complaint-tab" role="tab" aria-labelledby="nav-tabs">
              <form id="complaint-tab" action="" method="GET" novalidate="novalidate">
                <input type="hidden" id="Id" name="Id" value="42">
                <input type="hidden" id="Code" name="Code" value="C20240603084717">
                <input type="hidden" id="Complainant" name="Complainant" value="admin@gmail.com">
                <input type="hidden" id="CreatedDate" name="CreatedDate" value="06/03/2024 08:47:17">
                <input type="hidden" id="CreatedBy" name="CreatedBy" value="admin@gmail.com">
                <input type="hidden" id="CurrentURL" name="CurrentURL" value="/ComplaintManage/IndexAllComplained">

              </form>
            </div>
            <div class="tab-pane fade" id="attachment-file-tab" role="tabpanel" aria-labelledby="nav-profile-tab">
              <h4>Attachment File</h4>
              <div>
                <div class="row" style="width:100%; margin:0 auto;">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Complaint ID</th>
                        <th>File</th>
                        <th>complainant/Accused Edvience</th>
                        <th>Date</th>
                        <th>Upload By</th>
                      </tr>
                    </thead>
                    <tbody id="attachmentTableBody">

                    </tbody>
                  </table>
                </div>
                <hr>
                <form id="frmAttachmentFile" method="post" enctype="multipart/form-data" novalidate="novalidate">
                  <input type="hidden" value="42" id="ComplaintId" name="AttachmentFileCRUDViewModel.ComplaintId">
                  <div class="form-group">
                    <label for="AttachmentFile">Choose a file :</label>
                    <input type="file" id="AttachmentFile" name="AttachmentFile">
                  </div>
                  <div class="form-group">
                    <button type="button" class="btn btn-info" onclick="addNewAttachmentFile()">Add Attachment File</button>
                  </div>
                  <input name="__RequestVerificationToken" type="hidden" value="your-verification-token">
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="comment-tab" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div class="row">
                <h4>Comment History</h4>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="row" style="width:100%;">
                    <h5>Complainant's Comment</h5>
                    <div style="width:100%; height:170px; overflow-y: auto;">
                      <table class="ItemTranTable" style="border-collapse: collapse; width: 100%;">
                        <thead>
                          <tr>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment</th>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment By</th>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment Date</th>
                          </tr>
                        </thead>
                        <tbody id="complainant_comments">

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="row" style="width:100%;">
                    <h5>Accused's Comment</h5>
                    <style>
                      .ItemTranTable {
                        border-collapse: collapse;
                      }

                      .ItemTranTable td,
                      .ItemTranTable th {
                        border: 1px solid black;
                        padding: 8px;
                      }
                    </style>
                    <div style="width:100%; height:170px; overflow-y: auto;">
                      <table class="ItemTranTable" style="border-collapse: collapse; width: 100%; border: 1px solid #dddddd;">
                        <thead>
                          <tr>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment</th>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment By</th>
                            <th style="border: 1px solid #dddddd; padding: 8px;">Comment Date</th>
                          </tr>
                        </thead>
                        <tbody id="accused_comments">

                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
              <hr>
              <form id="frmComplaintDetails" method="post" novalidate="novalidate">
                <input type="hidden" value="42" data-val="true" data-val-required="The ComplaintId field is required." id="StatusUpdateViewModel_ComplaintId" name="StatusUpdateViewModel.ComplaintId">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="control-label" for="ComplainantComment">New Comment of Complainant</label>
                      <textarea id="complainantComment" class="form-control" name="complainantComment"></textarea>
                      <span class="text-danger field-validation-valid" data-valmsg-for="ComplainantComment" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                      <input type="button" value="Add Comment" class="btn btn-info" onclick="addComplainantComment('ComplainantComment')">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="control-label" for="AccusedComment">New Comment of Accused</label>
                      <textarea id="accusedComment" class="form-control" name="cccusedComment"></textarea>
                      <span class="text-danger field-validation-valid" data-valmsg-for="AccusedComment" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                      <input type="button" value="Add Comment" class="btn btn-info" onclick="addAccusedComment('AccusedComment')">
                    </div>
                  </div>
                </div>
                <input name="__RequestVerificationToken" type="hidden" value="CfDJ8K9r2JwY1fBFm1LQlSEeN_5_7ln6radVGWKxwC3ajl1Oe4mEnWuxGVXYtU43CsbXaGOPOKKO_8eM-6qv64AKDyQX-UqJGTXcMOfOteMUCIEvxnHKhIqy3ztdLwv1rXGXdJehr43D_VnMz2__mLKMCFQAhCU43_Xekj63My5k8YzjdOJ5HCIhD1AJ_MJQjEtIYQ">
              </form>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">{{ __("trans.Close")}}</button>
            <button type="submit" class="btn btn-primary btn-pill">{{ __("trans.Save Changes")}}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('scripts')
  <style>
    .ItemTranTable {
      font-size: 13px;
    }

    .ItemTranTable .btn {
      font-size: 13px;
    }
  </style>
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

    $(document).on('click', ".edit-complaint", function() {
      $("#complaint-tab").empty();
      $("#complainant_comments").empty();
      $("#accused_comments").empty();
      var complaintId = $(this).data('id');
      $("#complaint_id").val(complaintId);
      $.ajax({
        type: "POST",
        url: "{{route('getComplaintComments')}}",
        data: {
          "_token": "{{ csrf_token() }}",
          id: complaintId
        },
        success: function(data) {
          var res = JSON.parse(data);
          $("#complaint-tab").append(res.form);
          $("#complainant_comments").append(res.forComplainant);
          $("#accused_comments").append(res.forAccused);
          window.onload = function() {
            scrollToBottom();
          };
        }
      });
    });

    function addComplainantComment() {
      var complainantComment = $("#complainantComment").val();
      var complaint_id = $("#complaint_id").val();
      if (complainantComment != '') {
        $.ajax({
          type: "POST",
          url: "{{route('addComment')}}",
          data: {
            "_token": "{{ csrf_token() }}",
            complaint_id: complaint_id,
            comment: complainantComment,
            type: 'complainant'
          },
          success: function(data) {
            var res = JSON.parse(data);
            $("#complainantComment").val('');
            $("#complainant_comments").append(res.newRow);
            window.onload = function() {
              scrollToBottom();
            };
          }
        });
      }
    }

    function addAccusedComment() {
      var accusedComment = $("#accusedComment").val();
      var complaint_id = $("#complaint_id").val();
      if (accusedComment != '') {
        $.ajax({
          type: "POST",
          url: "{{route('addComment')}}",
          data: {
            "_token": "{{ csrf_token() }}",
            complaint_id: complaint_id,
            comment: accusedComment,
            type: 'accused'
          },
          success: function(data) {
            var res = JSON.parse(data);
            $("#accusedComment").val('');
            $("#accused_comments").append(res.newRow);
            window.onload = function() {
              scrollToBottom();
            };
          }
        });
      }
    }

    $(document).ready(function() {
    $('#btnUpdate').click(function() {
        UpdateComplaint();
    });
});
  </script>
  @endsection