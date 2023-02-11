<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name')}}</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="{{asset('storage/images/favicon.png')}}" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('vendor/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- Select2 -->
   <link rel="stylesheet" href="{{ asset('vendor/plugins/select2/css/select2.min.css')}}">
   <link rel="stylesheet" href="{{ asset('vendor/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('vendor/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendor/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  
  <link rel="stylesheet" href="{{ asset('vendor/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendor/dist/custom/app-custom.css')}}">
  
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  
  <nav class="main-header navbar navbar-expand-md text-light" id="navbar">


    <div class="container-fluid">
      <div>
      <button class="navbar-toggler order-1 text-light" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          
          <i class="fas fa-bars ms-1"></i>
        </span>
      </button>
      </div>
      <a href="{{route('index')}}" class="navbar-brand text-light ">
       {{--  <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"> --}}
        <span class="brand-text font-weight-light ">{{config('app.app_name')}}</span>
      </a>

      
      

      

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link text-light">Home</a>
          </li>
          @can('is-admin')
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-light">Management</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.index')}}" class="dropdown-item ">Manage Users</a></li>
              @can('is-superadmin')
              <li><a href="{{route('edit.terms',$term->id)}}" class="dropdown-item">Terms and Conditions</a></li>
              @endcan
              <li class="dropdown-divider"></li>

              <!-- Level two dropdown-->
              <li class="dropdown-submenu dropdown-hover">
                <a  href="{{route('edit.receivers')}}" role="button" class="dropdown-item">Inquiry Recipient Email</a>
                {{-- <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="{{route('edit.receivers')}}" class="dropdown-item">Inquiry Recepient Email</a> --}}
                  

                  {{-- <!-- Level three dropdown-->
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li>
                  <!-- End Level three -->

                  <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li> --}}
                
              </li>
              <!-- End Level two -->
            </ul>
          </li>
        
          @endcan
        </ul>
        <!-- SEARCH FORM -->
       {{--  @can('is-guidance-only')
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Student name.." aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        @endcan --}}
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
       {{--  <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> --}}
        {{-- <li class="nav-item">
          <span class="nav-link " >{{auth::user()->name}}</span>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link " data-toggle="dropdown" href="#">
            <i class="far fa-user text-light"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <a href="{{route('edit.profile')}}" class="dropdown-item">
              <i class="fas fa-user-cog"></i> Profile Settings
            </a>
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#change-pass">
              <i class="fas fa-lock"></i> Change Password
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" data-toggle="modal" data-target="#logout" class="dropdown-item">
              </i> <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </div>
        </li>
       
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- @yield('content_header') --}}
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Previous</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @can('is-admin')
          @if($configRecepient <= 0)
          <div class="alert alert-warning alert-block text-sm">
            <button type="button" class="close text-dark" data-dismiss="alert">x</button>
            <i class="fas fa-exclamation-triangle"></i> &nbsp;Please add recepient email address to avoid missing out inquiry emails from Students. Configure <a href="{{route('edit.receivers')}}">here</a>
          </div>
          @endif
        @endcan
        @include('partials.alert')
        <div class="row">
          <div class="col-lg-3">
            <!-- Profile Image -->
            @can('is-student-only')
            @if(!str_contains(url()->current(), 'profile/edit'))
            <div class="card  card-outline sticky-top">
                <div class="card-body box-profile">
                  <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle"
                          src="{{asset('storage/images/avatar/'.auth::user()->avatar)}}"
                          alt="User profile picture">
                  </div>
      
                  <h3 class="profile-username text-center">{{auth::user()->name}}</h3>
      
                  <p class="text-muted text-center">{{auth::user()->getUserPrimaryRole()->role}}</p>
      
                  <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{auth::user()->email}}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Section</b> <a class="float-right">@if(auth::user()->getSection){{auth::user()->getSection->section}}@endif</a>
                      </li>
                      <li class="list-group-item">
                        <b>Posts</b> <a class="float-right">@if(auth::user()->getPosts) {{auth::user()->getPosts->count()}} @endif</a> 
                        {{-- @if(auth::user()->gotDeactivated())(<a href="" class="text-danger" data-toggle="modal" data-target="#restorePostsModal">Restore Posts</a>)@endif --}}
                      </li>
                      
                  </ul>
                  @can('is-student-only')
                  <a href="#" class="btn btn-block text-light" data-toggle="modal" data-target="#deactivateModal"><b>Deactivate</b></a>
                  @endcan
                </div>
                <!-- /.card-body -->
            </div>
            @endif
            @endcan
            @can('is-guidance-only')
            @if(!str_contains(url()->current(), 'profile/edit'))
            <div class="card  card-outline sticky-top">
              <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{asset('storage/images/avatar/'.auth::user()->avatar)}}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{auth::user()->name}}</h3>
                <p class="text-muted text-center">{{auth::user()->getUserPrimaryRole()->role}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{auth::user()->email}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            @endif
           
           @endcan
            @can('is-admin')
              
                <div class="card  card-outline sticky-top">
                  <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{asset('storage/images/avatar/'.auth::user()->avatar)}}"
                            alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{auth::user()->name}}</h3>
                    <p class="text-muted text-center">{{auth::user()->getUserPrimaryRole()->role}}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{auth::user()->email}}</a>
                      </li>
                    </ul>
                  </div>
                  <!-- /.card-body -->
                </div>
          
              {{-- @include('partials.manage-section') --}}
            @endcan
            <!-- /.card -->
          </div>
          @yield('content')
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021-2022 <a href="#">University of Batangas</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
{{-- Logout Modal --}}
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title text-muted" id="exampleModalLongTitle"><i class="fas fa-sign-out-alt"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
          <p>Are you sure you want to logout?</p>
          
          </div>
          <div class="modal-footer">
               <a class="btn btn-flat btn-sm text-dark" style="background-color: white "
              href="#" data-dismiss="modal">
              <i class="far fa-times-circle"></i>
              {{ __('Cancel') }}
              </a>
              <a class="btn  btn-flat btn-sm text-light" style="background-color:#6690b3"
              href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-fw fa-power-off" ></i>
                Logout
              </a>
          </div>
      </div>
  </div>
</div>
{{-- Change password modal Modal --}}
<div class="modal fade" id="change-pass" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="{{route('edit.password')}}" method="post" id="changePass">
        @csrf
        @method('put')
        <div class="modal-header">
          <h5 class="modal-title text-muted" id="exampleModalLongTitle"><i class="fas fa-lock"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="password" class="form-control" name="current_password" placeholder="Current Password">
            <span class="text-danger error-text current_password_error"></span>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="new_password" placeholder="New Password">
            <span class="text-danger error-text new_passwoFrd_error"></span>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
            <span class="text-danger error-text confirm_password_error"></span>
          </div>
        
        </div>
        <div class="modal-footer">
            <a class="btn btn-flat btn-sm text-dark" style="background-color: white"
            href="#" data-dismiss="modal"> {{ __('Cancel') }} </a>
            <button type="submit" class="btn btn-flat btn-sm text-light">Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-------Upload Success added modal--------->
<div class="modal fade" id="change-pass-success-modal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body table-responsive p-0 text-sm">
          <div class="mb-4 p-3 bg-success">
              <h5>Success!</h5>
          </div>
          <div class="pl-4 pr-4 pb-4">
              <p><i class="far fa-check-circle"></i> Password has been changed!</p>
              <button type="button" class="btn btn-secondary btn-flat float-right mb-2 btn-flat" data-dismiss="modal" id="closeSuccessModal">Return</button>
          </div>
      </div>
      
    </div>
  </div>
</div>
<!----------------->
<!-----------Terms and Conditions------------>
<div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-justify">
        {!!$term->desc!!}
        <div class="form-check mt-3">
          <input type="checkbox" class="form-check-input" id="checkTerm">
          <label class="form-check-label" for="checkTerm" >I understand the terms & conditions</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-flat text-dark" data-dismiss="modal" style="background-color: white">Close</button>
        <a href="{{route('accept.terms')}}" class="btn btn-flat text-light" id="termConditionSubmit">Submit</a>
      </div>
    </div>
  </div>
</div>
<!------------------------------------------->
@can('is-student-only')
<!-----------Deactivate Account------------>
<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deactivate Your Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to deactivate your own account? <br>
        Please be informed that ALL your posts will be deleted as well.
        You can always reach us out through website CONTACT if you need to recover your account. Thank you!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-flat text-dark" data-dismiss="modal" style="background-color: white">Close</button>
        <form action="{{route('deactivate')}}" method="post">
          @csrf
          @method('DELETE')
          <button href="#" type="submit" class="btn btn-danger btn-flat">Deactivate</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-----------Restore Posts------------>
{{-- <div class="modal fade" id="restorePostsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restore Posts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to restore your posts?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="{{route('restore.posts')}}" method="post">
          @csrf
          @method('PUT')
          <button href="#" type="submit" class="btn btn-primary">Restore Posts</button>
        </form>
      </div>
    </div>
  </div>
</div> --}}
@endcan
<!------------------------------------------->

<!-- REQUIRED SCRIPTS -->
<form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
  @if(config('adminlte.logout_method'))
      {{ method_field(config('adminlte.logout_method')) }}
  @endif
  {{ csrf_field() }}
</form>



<!-- jQuery -->
<script src="{{ url('vendor/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery -->
<script src="{{ asset('vendor/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('vendor/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('vendor/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('vendor/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor/dist/js/adminlte.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('vendor/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- OPTIONAL SCRIPTS CHART -->
<script src="{{asset('vendor/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('vendor/dist/js/pages/dashboard2.js')}}"></script>
</body>
@can('is-student-only')
  @if(Session::get('privacy') == 1)
    <script>
      $('#privacyModal').modal('show');
    </script>
  @endif
@endcan

<script>

$('#termConditionSubmit').addClass('disabled');

$('#checkTerm').on("change", function(e){
  if ($(this).is(':checked')) {
      $('#termConditionSubmit').removeClass('disabled');
  } else {
      $('#termConditionSubmit').addClass('disabled');
  }
});

$(function(){
  $("#changePass").on('submit', function(e){
    e.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        //dataType:'file',
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },
        success:function(data){
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                  
                });
            }else{
                console.log(data);
                $('#change-pass').modal('hide');
                $('#change-pass-success-modal').modal('show');
                //var url ="{{ route('edit.profile') }}";
                //$(location).attr('href', url);
            }
        }
      });
    });
});

$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
});
</script>
@yield('custom_js')
</html>

