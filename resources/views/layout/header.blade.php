<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer-starter"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Admin|@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/favicon/favicon.ico')}}" />

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    

    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet"
        />
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{url('assets/vendor/fonts/boxicons.css')}}" />


    <style>
      /* Optional: Customize SweetAlert overlay */
      .swal2-container {
    z-index: 10500 !important;
    position: fixed;
}
      .swal2-container {
          background: rgba(0, 0, 0, 0.8); /* Black semi-transparent overlay */
      }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/core.css')}}" />
    <link rel="stylesheet" href="{{url('assets/vendor/css/rtl/theme-default.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  
    <!-- Page CSS -->

    <!-- Helpers -->

   
    <script src="{{url('assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{url('assets/js/config.js')}}"></script>
  </head>

  <body>
   
    <!-- Layout wrapper -->
   