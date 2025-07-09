@extends('admin.auth.layouts.master')
@section('title')
  News Portal | Forgot Password
@endsection
@section('content')
  <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>{{__('Forgot Password')}}</h4></div>

              <div class="card-body">
                <form method="POST" action="{{ route('admin.forgot-password.handle') }}" class="needs-validation" novalidate="">
                  @csrf
                  
                  @if (session()->has('success'))
                  <p>
                    <i><b class="text-success">{{ session()->get('success') }}</b></i>
                  </p>
                  @else
                    <p>{{__('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')}}</p>
                  @endif
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      {{__('Please fill in your email')}}
                    </div>
                    @error('email')
                      <code>{{ $message }}</code>
                    @enderror
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      {{__('Send Reset Link')}}
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              {{__('Copyright')}} &copy; {{__('news-portal 2025')}}
            </div>
          </div>
        </div>
@endsection