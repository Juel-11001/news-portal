@extends('admin.layouts.master')
@section('title')
    {{_('Category')}}
@endsection
@section('content')
<div class="section">
  <div class="section-header">
      <h1>{{__('All News')}}</h1>
  </div>
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
          <div class="card card-primary">
              <div class="card-header">
                  <h4>{{__('All News')}}</h4>
                  <div class="card-header-action">
                      <a href="{{route('admin.news.create')}}" class="btn btn-primary">
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
                        <th>{{__('Image')}}</th>
                        <th>{{__('Title')}}</th>
                        <th>{{__('Language Code')}}</th>
                        <th>{{__('category')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('In Slider')}}</th>
                        <th>{{__('In Breaking')}}</th>
                        <th>{{__('In Popular')}}</th>
                        <th>{{__('Action')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($newsByLanguage[$lang->lang] as $item)
                      <tr>
                        <td>{{$item->id}}</td>
                        <td><img src="{{asset($item->image)}}" alt="img" width="120px"></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->language}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>
                          <label class="custom-switch">
                              <input type="checkbox" {{$item->status == 1 ? 'checked' : ''}} name="status" class="custom-switch-input change-status" value="1" data-id="{{$item->id}}" data-name="status">
                              <span class="custom-switch-indicator"></span>
                          </label>
                        </td>

                        <td>
                         <label class="custom-switch">
                              <input type="checkbox" {{$item->show_at_slider == 1 ? 'checked' : ''}} name="show_at_slider" class="custom-switch-input change-status" value="1" data-id="{{$item->id}}" data-name="show_at_slider">
                              <span class="custom-switch-indicator"></span>
                          </label>
                        </td>
                        <td>
                         <label class="custom-switch">
                              <input type="checkbox" {{$item->is_breaking_news == 1 ? 'checked' : ''}} name="is_breaking_news" class="custom-switch-input change-status" value="1" data-id="{{$item->id}}" data-name="is_breaking_news">
                              <span class="custom-switch-indicator"></span>
                          </label>
                        </td>
                        <td>
                         <label class="custom-switch">
                              <input type="checkbox" {{$item->show_at_popular == 1 ? 'checked' : ''}} name="show_at_popular" class="custom-switch-input change-status" value="1" data-id="{{$item->id}}" data-name="show_at_popular">
                              <span class="custom-switch-indicator"></span>
                          </label>
                        </td>
                        <td class="action-column">
                          <a href="{{route('admin.news.edit', $item->id)}}" class="btn btn-primary my-2"><i class='far fa-edit'></i></a>
                          <a href="{{route('admin.news.destroy',$item->id )}}" class="btn btn-danger delete-item"><i class='fas fa-trash'></i></a>
                          <a href="{{route('admin.news-copy',$item->id )}}" class="btn btn-success"><i class='fas fa-copy'></i></a>
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
    // @foreach ($languages as $lang)  
    // $("#table-{{$lang->lang}}").dataTable({
    //   // order": [[0, "desc"]],
    //  "columnDefs": [
    //   { width: "150px", targets: 2 },
    //    { "sortable": false, 
    //    "targets": [2,3] }
    //    ]
    //  });
    // @endforeach
    // $(document).ready(function () {
    //   $('.change-status').on('click', function(){
    //     let id=$(this).data('id');
    //     let name=$(this).data('name');
    //     let status=$(this).prop('checked') ? 1 : 0;
    //     $.ajax({
    //       method:'get',
    //       url: "{{route('admin.change-news-status')}}",
    //       data :{
    //         id:id,
    //         name:name,
    //         status:status
    //       },
    //       success: function(data){
    //         if(data.status === 'success'){
    //             Toast.fire({
    //               icon: "success",
    //               title: data.message
    //             });
    //         }
    //       },
    //       error: function(xhr, status, error){
    //         console.log(error);
    //       }
    //     })
    //   })
    // })
    $(document).ready(function() {
            $('.image-preview').css({
                'background-image': '',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
  </script>
@endpush