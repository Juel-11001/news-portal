@extends('admin.layouts.master')
@section('title')
    Category
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>{{ __('Update Category') }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Update Category') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="select">{{__('Select Language')}}</label>
                                    <select name="language" id="select" class="form-control select2">
                                        <option value="">{{__('Select Language')}}</option>
                                        @foreach ($languages as $lang)
                                        <option {{$lang->lang===$category->language ? 'selected' : ''}} value="{{$lang->lang}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                     @error('language')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name ?? old('name') }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="default">{{__('Show at Nav')}}</label>
                                    <select name="show_at_nav" id="default" class="form-control">
                                        <option {{$category->show_at_nav === 0 ? 'selected' : ''}} value="0">{{__('No')}}</option>
                                        <option {{$category->show_at_nav === 1 ? 'selected' : ''}} value="1">{{__('Yes')}}</option>
                                    </select>
                                     @error('show_at_nav')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">{{__('Status')}}</label>
                                    <select name="status" id="default" class="form-control">
                                        <option {{$category->status === 1 ? 'selected' : ''}} value="1">{{__('Active')}}</option>
                                        <option {{$category->status === 0 ? 'selected' : ''}} value="0">{{__('Inactive')}}</option>
                                    </select>
                                     @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection