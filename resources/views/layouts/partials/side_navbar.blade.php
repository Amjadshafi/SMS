        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="{{route('dashboard')}}">
                <img src="{{ asset('theme/images/logo.png') }}" alt="">
                <span class="brand-name">{{!empty(Auth()->user()->organization->name) ? Auth()->user()->organization->name : "Admin"}}</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">

                <!--       <li>
                    <a class="sidenav-item-link" href="index.html">
                      <i class="mdi mdi-briefcase-account-outline"></i>
                      <span class="nav-text">Business Dashboard</span>
                    </a>
                  </li>                        
                   -->
                @auth
                @if(in_array(Auth::user()->roles->first()->name, ['Super Admin']))
                <li>
                  <a class="sidenav-item-link" href="{{route('dashboard')}}">
                    <i class="mdi mdi-chart-line"></i>
                    <span class="nav-text">{{ __("trans.Dashboard")}}</span>
                  </a>
                </li>
                @else
                <li>
                  <a class="sidenav-item-link" href="{{route('userdashboard')}}">
                    <i class="mdi mdi-account-details"></i>
                    <span class="nav-text">{{ __("trans.User Dashboard")}}</span>
                  </a>
                </li>
                @endif

                @role(['Super Admin','Admin'])
                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#settings" aria-expanded="false" aria-controls="settings">
                    <i class="mdi mdi-settings"></i>
                    <span class="nav-text">{{ __("trans.Permissions Hub")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="settings" data-parent="#sidebar-menu">
                    <div class="sub-menu">

                      <li>

                        <a class="sidenav-item-link" href="{{ route('roles.index') }}">
                          <span class="nav-text">{{ __("trans.Roles")}}</span>
                        </a>

                      </li>

                      <li>
                        <a class="sidenav-item-link" href="{{ route('permissions.create') }}">
                          <span class="nav-text">{{ __("trans.Permissions")}}</span>
                        </a>
                      </li>

                    </div>
                  </ul>
                </li>
                @endrole

                <li class="has-sub">
                  <a class="sidenav-item-link" href="{{ route('complaints.manage_complaint') }}">
                    <i class="mdi mdi-settings-outline"></i>
                    <span class="nav-text">{{ __("trans.Manage Complaint")}}</span> <b class="caret"></b>
                  </a>
                </li>
                <li class="has-sub">

                  <a class="sidenav-item-link" href="#" data-toggle="collapse" data-target="#Notification" aria-expanded="false" aria-controls="Notification">
                    <i class="mdi mdi-bell"></i>
                    <span class="nav-text">{{ __("trans.Notification")}}</span> <b class="caret"></b>
                  </a>
                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#file" aria-expanded="false" aria-controls="file">
                    <i class="mdi mdi-file"></i>
                    <span class="nav-text">{{ __("trans.Attachment File")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="file" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li>
                        <a href="{{ route('complaint.file') }}">{{ __("trans.Attachment File")}}</a>
                      </li>
                    </div>
                  </ul>
                </li>
                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#users" aria-expanded="false" aria-controls="users">
                    <i class="mdi mdi-account-multiple"></i>
                    <span class="nav-text">{{ __("trans.User")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="users" data-parent="#sidebar-menu">
                    <div class="sub-menu">

                      @role(['Super Admin','Admin','User'])
                      <li>
                        <a class="sidenav-item-link" href="{{ route('users.index') }}">
                          <span class="nav-text">{{ __("trans.Users")}}</span>
                        </a>
                      </li>
                      @endrole

                    </div>
                  </ul>
                </li>

                @role(['Super Admin','Admin'])
                <li class="has-sub">
                  <a class="sidenav-item-link" href="{{ route('organizationsList') }}" data-toggle="collapse" data-target="#Organization" aria-expanded="false" aria-controls="Organizations">
                    <i class="mdi mdi-school"></i>
                    <span class="nav-text">{{ __("trans.Organizations")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="Organization" data-parent="#sidebar-menu">
                    <div class="sub-menu">

                      <li>
                        <a class="sidenav-item-link" href="{{ route('organizationsList') }}">
                          <span class="nav-text">{{ __("trans.All Oganizations")}}</span>
                        </a>
                      </li>

                    </div>
                  </ul>
                </li>
                @endrole
                @role(['Super Admin','Admin','User'])
                <li class="has-sub">
                  <a class="sidenav-item-link" href="{{ route('allcommittees') }}" data-toggle="collapse" data-target="#committee" aria-expanded="false" aria-controls="committee">
                    <i class="mdi mdi-account-details"></i>
                    <span class="nav-text">{{ __("trans.Inquiry Committee")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="committee" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      @if(Auth::user()->role === 'Super Admin')
                      <li>
                        <a class="sidenav-item-link" href="{{ route('allcommittees') }}">
                          <span class="nav-text">{{ __("trans.All Committees")}}</span>
                        </a>
                      </li>
                      @endif
                      {{-- Add additional logic here if needed --}}
                    </div>
                  </ul>
                </li>
                </li>
                @endrole

                @role('Super Admin')
                <li class="has-sub">
                  <a class="sidenav-item-link" href="{{ route('categories.all') }}" data-toggle="collapse" data-target="#Category" aria-expanded="false" aria-controls="Category">
                    <i class="mdi mdi-format-list-bulleted"></i>
                    <span class="nav-text">{{ __("trans.Category")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="Category" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li>
                        <a class="sidenav-item-link" href="{{ route('categories.all') }}">
                          <span class="nav-text">{{ __("trans.All Category")}}</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
                @endrole

                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#Complaints" aria-expanded="false" aria-controls="Complaints">
                    <i class="mdi mdi-dropbox"></i>
                    <span class="nav-text">{{__("trans.Complaints")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="Complaints" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li>
                        <a href="{{ route('complaint.index') }}">
                          <span class="nav-text">{{__("trans.All Complaints")}}</span>
                        </a>
                      </li>
                      @role(['Super Admin','Admin'])
                      <li>
                        <a href="{{route('createComplaint')}}"><span class="nav-text">{{__("trans.Create New Complaint")}}</span></a>
                      </li>
                      @endrole

                      <li>
                        <a href="{{route('complaint.pending')}}">
                          <span class="nav-text">{{__("trans.Pending Complaints")}}</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('complaint.inprocess')}}"><span class="nav-text">{{__("trans.In Process")}}</span></a>
                      </li>
                      <li>
                        <a href="{{route('complaint.cancelled')}}"><span class="nav-text">{{__("trans.Cancelled Complaints")}}</span></a>
                      </li>
                      <li>
                        <a href="{{route('complaint.completed')}}"><span class="nav-text">{{__("trans.Completed Complaints")}}</span></a>
                      </li>
                    </div>
                  </ul>
                </li>
                @role('Super Admin')
                <li class="has-sub">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#Report" aria-expanded="false" aria-controls="Report">
                    <i class="mdi mdi-database"></i>
                    <span class="nav-text">{{ __("trans.Report")}}</span> <b class="caret"></b>
                  </a>
                  <ul class="collapse" id="Report" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li>
                        <a class="sidenav-item-link" href="{{route('complaints.assigned_complaint_summary')}}">
                          <span class="nav-text">{{ __("trans.Assigned To Summary")}}</span>
                        </a>
                      </li>
                      <li>
                        <a class="sidenav-item-link" href="{{route('complaints.status_summary')}}">
                          <span class="nav-text">{{ __("trans.Complaint Status Summary")}}</span>
                        </a>
                      </li>
                      <div>
                  </ul>
                </li>
                @endrole
                @endauth
              </ul>
            </div>
          </div>
        </aside>