<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/modules/summernote/summernote-bs4.css')}}">
   <link rel="stylesheet" href="{{asset('admin/assets/modules/select2/dist/css/select2.min.css')}}">
   
   <!-- Template CSS -->
   <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
   <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
   <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!-- Nav bar -->
      @include('admin.layouts.navbar')
      <!-- sidebar -->
      @include('admin.layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <!-- footer -->
      @include('admin.layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('admin/assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/popper.js')}}"></script>
  <script src="{{asset('admin/assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('admin/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('admin/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('admin/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/chart.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('admin/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('admin/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
   <script src="{{asset('admin/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js')}}"></script>
   <script src="{{asset('admin/assets/modules/select2/dist/js/select2.full.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('admin/assets/js/page/index-0.js')}}"></script>
    <!-- Page Specific preview image upload JS File -->
  {{-- <script src="{{asset('admin/assets/js/page/features-post-create.js')}}"></script> --}}
  
  <!-- Template JS File -->
  <script src="{{asset('admin/assets/js/scripts.js')}}"></script>
  <script src="{{asset('admin/assets/js/custom.js')}}"></script>
  {{-- sweet alert --}}
  @include('sweetalert::alert')
    <!-- Sweet Alert Js -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.delete-item', function(event){
            event.preventDefault();

            let deletUrl = $(this).attr('href');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: deletUrl,
                        success: function(data){
                            if(data.status == 'success'){
                                Swal.fire(
                                    'Deleted',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            } else if(data.status == 'error'){
                                Swal.fire(
                                    "Can't Delete!",
                                    data.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    });
                }
            });
        });
    });
    </script>
  @stack('scripts')
</body>
</html>