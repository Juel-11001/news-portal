@extends('admin.auth.layouts.master')
@section('title')
  News-portal |  Admin Login
@endsection
@section('content')
    <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{__('Login')}}</h4></div>
              @if (session()->has('success'))
                <i><b class="text-success">{{ session()->get('success') }}</b></i>
              @endif
              <div class="card-body">
                <form method="POST" action="{{ route('admin.login.handle') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="email">{{__('Email')}}</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      {{__('Please fill in your email')}}
                    </div>
                    @error('email')
                      <code>{{ $message }}</code>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">{{__('Password')}}</label>
                      <div class="float-right">
                        <a href="{{route('admin.forgot-password')}}" class="text-small">
                          {{__('Forgot Password?')}}
                        </a>
                       @error('password')
                          <code>{{ $message }}</code>
                        @enderror
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      {{__('please fill in your password')}}
                    </div>
                     @error('password')
                        <code>{{ $message }}</code>
                      @enderror
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">{{__('Remember Me')}}</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      {{__('Login')}}
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
             {{__('Don\'t have an account?')}} <a href="auth-register.html">{{__('Create One')}}</a>
            </div>
            <div class="simple-footer">
              {{__('Copyright')}} &copy; {{__('news-portal 2025')}}
            </div>
          </div>
        </div>
@endsection