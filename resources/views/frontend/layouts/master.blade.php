<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('frontend/assets/css/styles.css')}}" rel="stylesheet">
</head>

<body>

    <!-- Header news -->
    @include('frontend.layouts.header')
    <!-- End Header news -->

    @yield('content')

    <!-- footer -->
    @include('frontend.layouts.footer')

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{asset('frontend/assets/js/index.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#site_language').on('change', function(){
                let languageCode=$(this).val();
                $.ajax({
                    url:"{{route('language')}}",
                    type:"get",
                    data:{
                        "language_code":languageCode
                    },
                    success:function(data){
                        if(data.status === 'success'){
                            window.location.reload();
                        }
                    },
                    error:function(data){
                        console.log(data);
                    }
                })
            })
        })
    </script>
</body>

</html>