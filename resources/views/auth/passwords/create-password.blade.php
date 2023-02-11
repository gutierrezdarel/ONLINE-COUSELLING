@extends('layouts.app-login')
@section('content')
<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>UB Online Counseling</b> <span class="text-lg"> </span></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Please create your password.</p>
  
        <form method="POST" action="{{route('invitation.activate')}}">
            @csrf
            {{-- Token field --}}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group mb-3">
                <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="password_confirmation">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-8">
                
                </div>
                <!-- /.col -->
                <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
</div>
@endsection
