<div class="card">
  <div class="card-header">
    <h3 class="card-title">User Management</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    
    <div class="superadmin-settings text-left mb-2">
      <a href="" class="btn btn-sm btn-success btn-flat" data-toggle="modal" data-target="#addUserModal" title="Create new user"><i class="fas fa-user-plus"></i> Create</a>
      @can('is-superadmin')
        <a href="{{route('deactivated.students')}}" class="btn btn-danger btn-flat btn-sm" title="Deactivated Students"><i class="fas fa-user-lock"></i> Students</a>
      @endcan
    </div>
   
    <table id="example1" class="table table-bordered table-striped table-sm">
      <thead>
      <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Role</th>
        <th>Email</th>
        <th>Last Login</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>
            <span class="text-{{config('application.account_status_color.'.$user->status)}}">
              {{config('application.account_status.'.$user->status)}}
            </span>
          </td>
          <td>{{$user->getUserPrimaryRole()->role}}@if($user->getSection) (<span class="text-info">{{$user->getSection->section}}</span>)@endif</td>
          <td>{{$user->email}}</td>
          <td>
            @if($user->last_login)
              {{ Carbon\Carbon::parse($user->last_login)->diffForHumans()}} 
            @else 
              <span class="text-danger">Never</span> 
            @endif
          </td>
          <td>
            <div class="row">
              <div class="col-sm">
                  <a hre="#" class="btn btn-info btn-sm btn-flat" data-id="{{$user->id}}">
                      <i class="fas fa-edit"></i>
                  </a>
                  @if($user->status == 1)
                  <a href="#" class="btn btn-danger btn-flat btn-sm" title="Disable user" data-toggle="modal" data-target="#disable-{{$user->id}}">
                      <i class="fas fa-user-lock"></i>
                  </a>
                  @endif
                  @if($user->status == 0)
                  <a class="btn btn-success btn-sm btn-flat" href="#" title="Enable User"
                  onclick="event.preventDefault(); document.getElementById('enable-{{$user->id}}').submit();">
                  <i class="fas fa-user-check"></i>
                  </a>
                  <form action="{{route('user.enable',$user->id)}}" id="enable-{{$user->id}}" method="post">
                    @csrf
                    @method('PUT')
                  </form>
                  @endif
              </div>
            </div>
          </td>
        </tr>
         <!-- Disable Modal-->
        <div class="modal fade" id="disable-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="deletePost" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <form action="{{route('user.disable',$user->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Disable User Account</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  User will no longer have access to the system once disabled. Are you sure you want to proceed?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-danger btn-flat">Disable</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      @endforeach
     
      </tbody>
      <tfoot>
      <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Role</th>
        <th>Email</th>
        <th>Last Login</th>
        <th>Actions</th>
      </tr>
      </tfoot>
    </table>
</div>
<!-- Create User Modal -->
<div class="modal fade" id="addUserModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.store')}}" method="POST" id="addUserForm">
          @csrf
          @method('POST')
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Full Name">
            <span class="text-danger error-text name_error"></span>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            <span class="text-danger error-text email_error"></span>
            <small id="emailHelp" class="form-text text-muted">System will send an invitation to this email after creation.</small>
            
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Role</label>
            <select class="form-control" name="role" id="role">
              <option value="" selected disabled>Select User Role</option>
              @foreach ($roles as $role)
              <option value="{{$role->id}}">{{$role->role}}</option>
              @endforeach
            </select>
            <span class="text-danger error-text role_error"></span>
          </div>

          <div class="form-group" id="section-div">
            <label for="exampleInputPassword1">Student Section</label>
            <select class="form-control select2bs4" name="student_section" id="student_section">
              <option value="" selected disabled>Select Student Section</option>
              @foreach ($sections as $section)
              <option value="{{$section->id}}">{{$section->section}}</option>
              @endforeach
            </select>
            <span class="text-danger error-text student_section_error"></span>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit User Modal-->
<div class="modal fade" id="editUserModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.update')}}" method="POST" id="editUserForm">
          @csrf
          @method('PUT')
          <div class="form-group">
            
            <label for="name">Name</label>
            <input type="hidden" name="user_id" id="user-id">
            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter Full Name">
            <span class="text-danger error-text name_error"></span>
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="edit-email" aria-describedby="emailHelp" name="email" placeholder="Enter email">
            <span class="text-danger error-text email_error"></span>
    
            
          </div>
          <div id="section-role-edit">
            
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!--------Invitation Success added modal--------->
<div class="modal fade" id="inviteSuccessModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body table-responsive p-0 text-sm">
          <div class="mb-4 p-3 bg-success">
              <h5>User created!</h5>
          </div>
          <div class="pl-4 pr-4 pb-4">
              <h5><i class="far fa-check-circle"></i> Invitation has been sent!</h5>
              <button type="button" class="btn btn-secondary btn-flat float-right mb-2" data-dismiss="modal" id="closeSuccessModal">Return</button>
          </div>
      </div>
      
    </div>
  </div>
</div>
<!----------------->