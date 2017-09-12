@include('layouts.head')

<body class="page-header-fixed page-full-width" style="overflow:hidden">
    <!-- loading preloader -->
    <div id="loading"> 
        <div id="loading-container" class="fullwidth">
            <div class="spinner">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
              <div></div>
            </div>
            <p id='loading-text'>Loading...</p>
        </div>
    </div>    <!-- Header -->
	<div class="header navbar navbar-fixed-top mega-menu">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="header-inner">
            <!-- BEGIN LOGO -->
            <a class="navbar-brand" href="/">
                <img src="{{URL::asset('Elegantic/images/ALS-logo.jpg')}}"  class="img-responsive"/>
            </a>
            <!-- END LOGO -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <!-- <img src="assets/img/menu-toggler.png" alt=""/> -->
                <i class="fa fa-bars"></i>
            </a>
			<!-- END HORIZANTAL MENU -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right" style="cursor: pointer;">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                @if (Auth::guest()) 
                    <li><a style="margin-top:10px;" class="btn btn-small btn-sm pull-right hijau-muda" href="{{ route('login') }}">Login <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a></li>
                @else
                    <li class="dropdown user">
                         
                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" src="assets/img/avatar1_small.jpg"/>
                            <span class="username hidden-1024">{{Auth::user()->get_nama()}}</span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="login">
                                @if(Auth::user()->is_admin == 1)
                                    <a href="/personnel">
                                        Acting As Admin
                                    </a>
                                @endif
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                    style="
                                    :hover{
                                        background-color: red;
                                    }"
                                >
                                    Logout
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- END TOP NAVIGATION MENU -->
            <!-- BEGIN HORIZANTAL MENU -->
            <div class="hor-menu hidden-sm hidden-xs navbar-collapse collapse">
				<ul class="nav navbar-nav">
                    <li class="classic-menu-dropdown">
						<a href="/">
							 Home
						</a>
					</li>
					<li class="classic-menu-dropdown"><a href="/news-board">News</a></li>
					@if(Auth::user())
					<li class="classic-menu-dropdown"><a href="{{url('/forum')}}">Forum</a></li>
					<li class="classic-menu-dropdown">
							<a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="#">
							My Modules <i class="fa fa-angle-down"></i>
							<span class="selected">
							</span>
							</a>
						
						<ul class="dropdown-menu">
							@foreach ($module as $modul)
								<li>
									<a href="/module/{{$modul->id}}">{{$modul->nama}}</a>
								</li>
							@endforeach
						</ul>
					</li>
					<li class="classic-menu-dropdown active"><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
					@endif
				</ul>
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
	<div class="clearfix"></div>

	<div class="page-container" id="wrapper">
       	<div class="page-content-wrapper"> 
		<div class="page-sidebar navbar-collapse collapse">
             
			 <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="active">
					<a href="/">
						 Home
						<span class="selected">
						</span>
					</a>
				</li>
				<li class=""><a href="/news-board">News</a></li>
				@if(Auth::user())
				<li class=""><a href="{{url('/forum')}}">Forum</a></li>
				<li class="classic-menu-dropdown">
					<a>
						My Modules <i class="arrow fa fa-angle-down"></i>
					</a>
					<ul class="sub-menu">
						@foreach ($module as $modul)
							<li>
								<a href="/module/{{$modul->id}}">{{$modul->nama}}</a>
							</li>
						@endforeach
					</ul>
				 
				</li>
					
				 
				<li class=""><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
				@endif
			</ul>

        </div>
        	<div class="page-content">			
			<br><br>
						<div class="col-md-12">
							<div class="panel panel-success">
								<div class="panel-heading">Reset Password</div>
								<div class="panel-body">
							  <form id="myform" class="form-horizontal" action="/reset-password" role="form" method="POST">
							  
							  {{ csrf_field() }}

							  <input type="hidden" name="id_user" value="{{Auth::user()->id}}">

							  
								<div class="form-group">
									<label for="password" class="col-md-4 control-label">New Password</label>

									<div class="col-md-4">
										<input  type="password" id="new_pass" class="form-control" name="newpassword" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

									<div class="col-md-4" id="div_confirm">
										<input  id="confirm_pass"  type="password" class="form-control"  required>
										
									</div>
									<div id="message"></div>
								</div>
								
								<br><br>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" id="btn-sub" class="btn btn-primary" disabled="true">
											Reset Password
										</button>
									</div>
								</div>								
							  </form>
							</div>
							</div>
						</div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @include('layouts.script')
</body>
</html>
<script type="text/javascript" src="{{URL::asset('js/textarea.js')}}"></script>
<style>
p.big {
    line-height: 300%;
	font-size : 15px;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		
	

		$('#confirm_pass').on('input',function(e){
			var new_pass = $('#new_pass').val();
			var confirm_pass = $('#confirm_pass').val();
		 	
		 	if (new_pass === confirm_pass) {
				$('#message').html('*correct');
				$(':input[type="submit"]').prop('disabled', false);

			}else{
				$('#message').html('*your password is false');
				$(':input[type="submit"]').prop('disabled', true);
			}
		});

		$('#new_pass').on('input',function(e){
			var new_pass = $('#new_pass').val();
			var confirm_pass = $('#confirm_pass').val();
		 	
		 	if (confirm_pass !== "") {
			 	if (new_pass === confirm_pass) {
					$('#message').html('*correct');
					$(':input[type="submit"]').prop('disabled', false);

				}else{
					$('#message').html('*your password is false');
					$(':input[type="submit"]').prop('disabled', true);
				}
			}
		});
		
		

		
		
	});
</script>
<script>

     $(window).load(function(){
    
       setTimeout(function() {    
        $("#loading").fadeOut(function(){
          
           $(this).remove();
               $('body').removeAttr('style');
            }) 
        }
       , 300);
    });


    jQuery(document).ready(function() {
   // initiate layout and plugins
    App.init();
       
    });
</script>
