<!DOCTYPE html>
<html>
<head>

<title>Laravel 10 CRUD Application - Haripada Jena</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Css -->
<link href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="{{asset('assets/libs/datatables/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />
<link href="{{asset('assets/libs/datatables/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('assets/libs/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />
</head>

<body>
<div class="container">
    @yield('content')
</div>
 <!-- JAVASCRIPT -->
 <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Required datatable js -->
 <script src="{{asset('assets/libs/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <!-- Buttons examples -->
 <script src="{{asset('assets/libs/datatables/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
 <!-- Responsive examples -->
 <script src="{{asset('assets/libs/datatables/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
@yield('script')
</body>

</html>

