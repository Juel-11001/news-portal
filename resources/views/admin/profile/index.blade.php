@extends('admin.layouts.master')
@section('title')
    Update Profile
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Profile') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Profile') }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.profile.update', $user->id) }}" enctype="multipart/form-data" >
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-header">
                                <h4>{{ __('Edit Profile') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('Name') }}</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}"
                                            required="" name="name">
                                        <div class="invalid-feedback">
                                            {{ __('Please fill in the name') }}
                                        </div>
                                        @error('name')
                                          <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control" value="{{ $user->email }}"
                                            required="" name="email">
                                        <div class="invalid-feedback">
                                            {{ __('Please fill in the email') }}
                                        </div>
                                         @error('email')
                                          <p><b class="invalid-feedback">{{ $message }}</b></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" form-group col-sm-12 col-md-12">
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                            <input type="file" name="image" id="image-upload">
                                            <input type="hidden" name="old_image" value="{{ $user->image }}">
                                        </div>
                                         
                                    </div>
                                  </div>
                                  @error('image')
                                      <p class="text-danger">{{ $message }}</p>
                                  @enderror

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="">
                            <div class="card-header">
                                <h4>{{ __('Change Password') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('Old Password') }}</label>
                                        <input type="password" name="old_password" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            {{ __('Please fill in the old password') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('New Password') }}</label>
                                        <input type="password" name="password" class="form-control" required="">
                                        <div class="invalid-feedback">
                                            {{ __('Please fill in the new password') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 col-12">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required="">
                                        <div class="invalid-feedback">
                                            {{ __('Please fill in the confirm password') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $.uploadPreview({
            input_field: "#image-upload", // Default: .image-upload
            preview_box: "#image-preview", // Default: .image-preview
            label_field: "#image-label", // Default: .image-label
            label_default: "Choose File", // Default: Choose File
            label_selected: "Change File", // Default: Change File
            no_label: false, // Default: false
            success_callback: null // Default: null
        });
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($user->image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
