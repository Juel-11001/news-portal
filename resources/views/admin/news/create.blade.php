@extends('admin.layouts.master')
@section('title')
    News
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>{{ __('News') }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Create News') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.news.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="select">{{__('Select Language')}}</label>
                                    <select name="language" id="select-language" class="form-control select2">
                                        <option value="">{{__('Select Language')}}</option>
                                        @foreach ($languages as $lang)
                                        <option value="{{$lang->lang}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('language')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                               
                                <div class="form-group col-md-6">
                                    <label for="select">{{__('Select')}}</label>
                                    <select name="category" id="select-category" class="form-control select2">
                                        <option value="">{{__('Select')}}</option>
                                    </select>
                                     @error('category')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                     @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="content">{{__('Content')}}</label>
                                    <textarea name="content" class="summernote"></textarea>
                                     @error('content')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="meta_title">{{__('Meta Title')}}</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                                     @error('meta_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="meta_description">{{__('Meta Description')}}</label>
                                    <textarea name="meta_description" class="summernote-simple"></textarea>
                                     @error('meta_description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="control-label">{{__('Breaking News')}}</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="is_breaking_news" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @error('is_breaking_news')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="control-label">{{__('Show At Slider')}}</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="show_at_slider" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @error('show_at_slider')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="control-label">{{__('Show At Popular')}}</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="show_at_popular" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @error('show_at_popular')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="control-label">{{__('Status')}}</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="status" class="custom-switch-input" value="1">
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 my-auto">
                                    <label class="">Tags</label>
                                        <input type="text" class="form-control inputtags" style="display: none;" name="tags">
                                     @error('tags')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                        <label>{{__('Image')}}</label>
                                        <div id="image-preview" class="image-preview mx-auto">
                                            <label for="image-upload" id="image-label">{{ __('Choose File') }}</label>
                                            <input type="file" name="image" id="image-upload">
                                            {{-- <input type="hidden" name="old_image" value="{{ $user->image }}"> --}}
                                        </div>
                                     @error('image')
                                        <p class="text-danger text-center">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Create')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".inputtags").tagsinput('items');
        $(document).ready(function() {
            $('#select-language').on('change', function () {
                let lang=$(this).val();
                $.ajax({
                    url: "{{ route('admin.get-categories')}}",
                    method: 'get',
                    data: {
                        lang: lang,
                    },
                    success: function (data) {
                        $('#select-category').html();
                        $('#select-category').html(`<option value="">{{__('Select Category')}}</option>`);
                        $.each(data, function(index, data){
                            $('#select-category').append(`<option value="${data.id}">${data.name}</option>`)
                        })
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            })
        })
    </script>
@endpush

