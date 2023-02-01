<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EMPRESA XYZ</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">


  <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  


  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body id="page-top" onload="renderTime();">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
        @include('components._sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('components._topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
          @yield('content')
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('components._footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  

  <!-- Bootstrap core JavaScript-->



  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

  

  @yield('scripts')

</body>

</html>
