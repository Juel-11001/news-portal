@extends('admin.auth.layouts.master')
@section('title')
  News Portal | Reset Password
@endsection
@section('content')
  <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{__('Reset Password')}}</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('admin.reset-password.handle') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="email">{{__('Email')}}</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="{{request()->email}}">
                    <input type="hidden" name="token" value="{{request()->token}}">
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
                    <div class="d-block">
                    	<label for="password" class="control-label">{{__('Confirm Password')}}</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                    <div class="invalid-feedback">
                      {{__('please fill in your confirm password')}}
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      {{__('Reset')}}
                    </button>
                  </div>
                </form>
              </div>
            </div>
            {{-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> --}}
            <div class="simple-footer">
              {{__('Copyright')}} &copy; {{__('news-portal 2025')}}
            </div>
          </div>
        </div>
@endsection