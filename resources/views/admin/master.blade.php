<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>@yield('title')</title>

    <!-- Favicons -->
    <link href="{{asset('admin/img')}}/favicon.png" rel="icon">
    <link href="{{asset('admin/img')}}/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('admin/lib')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('admin/lib')}}/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('admin')}}/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/lib')}}/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="{{asset('admin')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('admin')}}/css/style-responsive.css" rel="stylesheet">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!-- =======================================================
      Template Name: House Rent
      Author: Rumon and Lalshan
    ======================================================== -->


    @stack('css')

</head>
<body>
<section id="container">

    <!--header start-->
      @include('admin.inc.header')
    <!--header end-->



    <!-- *****************************************************************
          MAIN SIDEBAR MENU
    **************************************************************** **-->
        
    <!--sidebar start-->
      @include('admin.inc.sidebar')
    <!--sidebar end-->

    <!--*****************************************************************
            MAIN CONTENT
    ***************************************************************-->
    <!--main content start-->

    @yield('content')

    <!--main content end-->

    <!--footer start-->
    @include('admin.inc.footer')
    <!--footer end-->

    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('admin/lib')}}/jquery/jquery.min.js"></script>

    <script src="{{asset('admin/lib')}}/bootstrap/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="{{asset('admin/lib')}}/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{asset('admin/lib')}}/jquery.scrollTo.min.js"></script>
    <script src="{{asset('admin/lib')}}/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{asset('admin/lib')}}/jquery.sparkline.js"></script>
    <!--common script for all pages-->
    <script src="{{asset('admin/lib')}}/common-scripts.js"></script>
    <script type="text/javascript" src="{{asset('admin/lib')}}/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="{{asset('admin/lib')}}/gritter-conf.js"></script>

    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

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
