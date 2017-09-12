@include('Admin.Adminhead')

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{URL::asset('AdminLTE/dist/js/app.min.js')}}"></script>  

<body class= "hold-transition skin-green sidebar-mini">
		  <div class="wrapper">
		  @include('Admin.header')
			<!-- Left side column. contains the logo and sidebar -->
		  @include('Admin.sidebar')
		  <!-- Content Wrapper. Contains page content -->
			  <div class="content-wrapper">
			  <!-- Content Header (Page header) -->
			  <!-- Main content -->
				  <section class="content" style="font-weight:normal">
					 
					  <div class="row">
							  
						  @yield('section')
						 
					   </div>
				  
				  </section>
			  
			  </div>
				<!-- /.content-wrapper -->
			  <!-- /.control-sidebar -->
			  <!-- Add the sidebar's background. This div must be placed
				   immediately after the control sidebar -->
		  

	  @include('Admin.Footer')
	  <!-- /.control-sidebar -->
	  <!-- Add the sidebar's background. This div must be placed
		   immediately after the control sidebar -->
	  <div class="control-sidebar-bg"></div>

	</div>
</body>
</html>