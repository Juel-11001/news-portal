@extends('admin.layouts.master')
@section('title')
    {{_('Category')}}
@endsection
@section('content')
<div class="section">
  <div class="section-header">
      <h1>{{__('All Categories')}}</h1>
  </div>
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
          <div class="card card-primary">
              <div class="card-header">
                  <h4>{{__('All Categories')}}</h4>
                  <div class="card-header-action">
                      <a href="{{route('admin.category.create')}}" class="btn btn-primary">
                          <i class="fas fa-plus"></i> 
                          {{__('Create')}}
                      </a>
                  </div>
              </div>
              <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($languages as $lang)    
                    <li class="nav-item">
                      <a class="nav-link {{$loop->index === 0 ? 'active' : ''}}" id="home-tab2" data-toggle="tab" href="#home-{{$lang->lang}}" role="tab" aria-controls="home" aria-selected="true">{{_($lang->name)}}</a>
                    </li>
                    @endforeach
                  </ul>
                  <div class="tab-content tab-bordered" id="myTab3Content">
                    @foreach ($languages as $lang)  

                    <div class="tab-pane fade show {{$loop->index===0 ? 'active' : '' }}" id="home-{{$lang->lang}}" role="tabpanel" aria-labelledby="home-tab2">
                      <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-striped" id="table-{{$lang->lang}}">
                      <thead>
                        <tr>
                        <th class="text-center">{{__('#')}}</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Language Code')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Show Nav')}}</th>
                        <th>{{__('Action')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($categories[$lang->lang] as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->language}}</td>
                        <td>
                          @if ($category->status == 1)
                          <div class="badge badge-primary">{{_('Active')}}</div>
                          @else
                          <div class="badge badge-danger">{{_('Inactive')}}</div>
                          @endif
                        </td>

                        <td>
                          @if ($category->show_at_nav == 1)
                          <div class="badge badge-success">{{_('Yes')}}</div>
                          @else
                          <div class="badge badge-danger">{{_('No')}}</div>
                          @endif
                        </td>
                        <td>
                          <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-primary"><i class='far fa-edit'></i></a>
                          <a href="{{route('admin.category.destroy',$category->id )}}" class="btn btn-danger delete-item"><i class='fas fa-trash'></i></a>
                      </td>
                      </tr>
                      @endforeach
                    </tbody></table>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
          </div>
      </div>
  </div>
</div>
@endsection
@push('scripts')
  <script>
    @foreach ($languages as $lang)  
    $("#table-{{$lang->lang}}").dataTable({
     "columnDefs": [
       { "sortable": false, 
       "targets": [2,3] }
       ]
     });
    @endforeach
  </script>
@endpush