<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Sinte for Web" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
</head>
<body class="skin-blue">
  <div class="wrapper">
      <!-- Header -->
      @include('layouts.header')
      <!-- Sidebar -->
      @include('layouts.sidebar')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  @yield('title')
                  <small>{{ $page_description or null }}</small>
              </h1>
              <!-- You can dynamically generate breadcrumbs here -->
              <ol class="breadcrumb">
                  <li><a href="/"><i class="fa fa-dashboard"></i>Início</a></li>
                  @yield('ref')
                  @yield('ref1')
              </ol>
          </section>

          <!-- Main content -->
          <section class="content">
              <!-- Your Page Content Here -->
              @yield('content')
          </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('layouts.footer')

  </div><!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 2.1.3 -->
  <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js") }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>
  <!-- DataTables -->
  <script src="http://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <!-- TreeView -->
  <script src="{{ asset('/bower_components/bootstrap-treeview/public/js/bootstrap-treeview.js') }}"></script>
  <!-- App scripts -->
  @stack('scripts')

</body>
</html>
