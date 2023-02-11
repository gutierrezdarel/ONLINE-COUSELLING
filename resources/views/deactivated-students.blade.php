@extends('layouts.app')

@section('content')
@section('content_header')
<h1 class="m-0"> Manage Profile <small></small></h1>
@stop
<div class="col-lg-9 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            List of deactivated students
        </div>
        <div class="card-body">
            @if($users->count())
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
                            <a class="btn btn-success btn-sm" href="#" title="Enable User"
                            onclick="event.preventDefault(); document.getElementById('enable-{{$user->id}}').submit();">
                            <i class="fas fa-user-check"></i> Reactivate
                            </a>
                            <form action="{{route('reactivate.students',$user->id)}}" id="enable-{{$user->id}}" method="post">
                              @csrf
                              @method('PUT')
                            </form>
                           
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Disable</button>
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
            @else
            <p>No deactivated students found!</p>
            @endif
        </div>
    </div>
</div>

@endsection