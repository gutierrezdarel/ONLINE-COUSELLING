@extends('layouts.app-login')


@section('content')
<link rel="stylesheet" href="{{ asset('vendor/dist/custom/main-page-custom.css')}}">

<div class="login-box">
    <div class="login-logo">
      <a href="#"><b>UB Online Counseling</b> <span class="text-lg"> </span></a>
    </div>
    <!-- /.login-logo -->
    <div class="text-sm">
      @include('partials.alert')
    </div>
    
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="input-group mb-3">
            <input type="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
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
          <div class="row">
            
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-block text-light">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <div class="row">
        <p class="mb-1 mr-5 p-1">
         
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </p>
        <p class="mb-0 ml-5 p-1">
        
            
            <a href="{{ route('index') }}" class="text-center">Previous</a>
           
        </p>
        <p class="text-center">If you do not have an account yet kindly go to the Contact section and fill out the form.</p>
      </div>
      </div>
      <!-- /.login-card-body -->
    </div>
    
</div>
@endsection

