@extends('admin.layouts.master')
@section('title')
    Language
@endsection
@section('content')
<div class="section">
    <div class="section-header">
        <h1>{{__('All Languages')}}</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{__('All Languages')}}</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.language.create')}}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> 
                            {{__('Create')}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                     <div class="table-responsive">
                      <table class="table table-striped dataTable" id="table-language">
                        <thead>
                          <tr>
                            <th>{{__('#')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Default')}}</th>
                            <th>{{__('Action')}}</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($languages as $lang)
                        <tr>
                          <td>{{$lang->id}}</td>
                          <td>{{$lang->name}}</td>
                          <td>
                            @if ($lang->status == 1)
                            <div class="badge badge-primary">{{__('Active')}}</div>
                            @else
                            <div class="badge badge-danger">{{__('Inactive')}}</div>
                            @endif
                          </td>

                          <td>
                            @if ($lang->default == 1)
                            <div class="badge badge-success">{{__('Yes')}}</div>
                            @else
                            <div class="badge badge-danger">{{__('No')}}</div>
                            @endif
                          </td>
                          <td>
                            <a href="{{route('admin.language.edit', $lang->id)}}" class="btn btn-primary"><i class='far fa-edit'></i></a>
                            <a href="{{route('admin.language.destroy', $lang->id)}}" class="btn btn-danger delete-item"><i class='fas fa-trash'></i></a>
                        </td>
                        </tr>
                        @endforeach
                      </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
  <script>
    $("#table-language").dataTable({
     "columnDefs": [
       { "sortable": false, 
       "targets": [2,3] }
       ]
     });
  </script>
@endpush
