<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="{{asset('frontEnd/assets')}}/bootstrap/css/bootstrap.css" />
    <link href="{{asset('frontEnd/assets/fonts')}}/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="{{asset('frontEnd/assets')}}/bootstrap/js/bootstrap.js"></script>
    <script src="{{asset('frontEnd/assets')}}/script.js"></script>

    <!-- Owl stylesheet -->
    <link rel="stylesheet" href="{{asset('frontEnd/assets')}}/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{asset('frontEnd/assets')}}/owl-carousel/owl.theme.css">
    <script src="{{asset('frontEnd/assets')}}/owl-carousel/owl.carousel.js"></script>
    <!-- Owl stylesheet -->

    <!-- slitslider -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontEnd/assets')}}/slitslider/css/style.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontEnd/assets')}}/slitslider/css/custom.css" />
    <script type="text/javascript" src="{{asset('frontEnd/assets')}}/slitslider/js/modernizr.custom.79639.js"></script>
    <script type="text/javascript" src="{{asset('frontEnd/assets')}}/slitslider/js/jquery.ba-cond.min.js"></script>
    <script type="text/javascript" src="{{asset('frontEnd/assets')}}/slitslider/js/jquery.slitslider.js"></script>
    <!-- slitslider -->

    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('frontEnd/assets/style.css')}}"/>
    <!-- /.custom css -->

    <link rel="stylesheet" href="{{asset('toastr')}}/css/toastr.min.css">

    {{--<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">--}}

    @stack('css')

</head>

<!-- Header -->
    @include('frontEnd.inc.header')
<!-- //Header Ends -->

<!-- banner -->
    @yield('banner')
<!-- //banner Ends -->


<!-- Content -->
    @yield('mainContent')
<!-- //Content Ends -->

<!-- Footer -->
    @include('frontEnd.inc.footer')
<!-- //Footer Ends -->


    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <!-- //js Header fixed -->
    <script>
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                  toastr.error('{{ $error }}','Error',{
            closeButton:true,
            progressBar:true,
        });
        @endforeach
        @endif
    </script>

    @stack('js')

</body>
</html>





