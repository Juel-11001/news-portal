@extends('admin.layouts.master')
@section('title')
    Language
@endsection
@section('content')
    <div class="section">
        <div class="section-header">
            <h1>{{ __('Update Language') }}</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ __('Update Language') }}</h4>
                        <div class="card-header-action">
                            <a href="{{ route('admin.language.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.language.update', $lang->id) }}') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="select">{{__('Select Language')}}</label>
                                    <select name="lang" id="select" class="form-control select2">
                                        <option value="">{{__('Select Language')}}</option>
                                        @foreach (config('language') as $key => $value)
                                        <option
                                         @if ($lang->lang === $key)
                                            selected
                                        @endif
                                         value="{{ $key }}">{{$value['name']}}</option>
                                        @endforeach
                                    </select>
                                    @error('lang')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name" readonly value="{{$lang->name}}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slug">{{__('Slug')}}</label>
                                    <input type="text" readonly class="form-control" id="slug" name="slug" value="{{$lang->slug}}">
                                    @error('lang')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="default">{{__('Is It Default')}}</label>
                                    <select name="default" id="default" class="form-control">
                                        <option {{$lang->default == 0 ? 'selected' : ''}} value="0">{{__('No')}}</option>
                                        <option {{$lang->default == 1 ? 'selected' : ''}} value="1">{{__('Yes')}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">{{__('Status')}}</label>
                                    <select name="status" id="default" class="form-control">
                                        <option {{$lang->status == 1 ? 'selected' : ''}} value="1">{{__('Active')}}</option>
                                        <option {{$lang->status == 0 ? 'selected' : ''}} value="0">{{__('Inactive')}}</option>
                                    </select>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#select').on('change', function () {
                let value = $(this).val();
                $('#slug').val(value);
                $('#name').val($('#select option:selected').text());
            });
        });
    </script>
@endpush
