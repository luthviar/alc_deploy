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
    </div>	<!-- Header -->
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

					<li class="classic-menu-dropdown active"><a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="#">
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
					<li class="classic-menu-dropdown"><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
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
				<li class="">
					<a href="/">
						 Home
						<span class="selected">
						</span>
					</a>
				</li>
				<li class=""><a href="/news-board">News</a></li>
				@if(Auth::user())
				<li class=""><a href="{{url('/forum')}}">Forum</a></li>
				<li class="classic-menu-dropdown active">
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
	   	@if(empty($next_section))
			{{--kalau true berarti sedang post test--}}
        <div class="page-content" style="">		
		<section id="main">
			<div class="container">
				<div class="row">
					<div class="btn-group btn-breadcrumb">
						<a href="#" class="btn btn-default">Introduction</a>
						<a class="btn btn-default">Pre-Test</a>
						<a class="btn btn-default">Modul</a>
						<a class="btn btn-success">Post-Test</a>
					</div>
					{{--<div class="btn-group btn-breadcrumb">--}}
						{{--<a class="btn btn-default">Training</a>--}}
						{{--<a class="btn btn-danger">Test Result</a>--}}
					{{--</div>--}}
				</div>
	   
			</div>
			<br>
			
			<div class="block-advice">
					<div class = "text-center">
					<h2 class="brand-before">
							<small>{{$training->title}}</small>
						</h2>
						<h1 class="brand-name">Hasil Test</h1>
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
									    <h3 class="panel-title"><strong>Pre-Test Score</strong></h3>
									</div>
									<div class="panel-body" style="font-size: 100px;">
									    {{$skor_pre_test or 'null'}}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
									    <h3 class="panel-title"><strong>Post-Test Score</strong></h3>
									</div>
									<div class="panel-body" style="font-size: 100px;">
									    {{$skor_post_test or 'null'}}
									</div>
								</div>
							</div>
						</div>
						<br>
						<h6>
						
							<a class="btn darkgreen" href="/">Next</a>
						
						</h6>
						
					</div>
				</div>
			</section>
		</div>

	@else
		{{--kalau false berarti pre-test--}}
        <div class="page-content" style="">	
		<section id="main">
			<div class="container">
				<div class="row">
					<div class="btn-group btn-breadcrumb">
						<a href="#" class="btn btn-default">Introduction</a>
						<a class="btn btn-success">Pre-Test</a>
						<a class="btn btn-default">Modul</a>
						<a  class="btn btn-default">Post-Test</a>
					</div>
					{{--<div class="btn-group btn-breadcrumb">--}}
						{{--<a class="btn btn-default">Training</a>--}}
						{{--<a class="btn btn-danger">Test Result</a>--}}
					{{--</div>--}}
				</div>
	   
			</div>
			<br>
			
			<div class="block-advice">
					<div class = "text-center">
					<h2 class="brand-before">
							<small>{{$training->title}}</small>
						</h2>
						<h1 class="brand-name">Hasil Test</h1>
							
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
									    <h3 class="panel-title"><strong>Pre-Test Score</strong></h3>
									</div>
									<div class="panel-body" style="font-size: 100px;">
									    {{$skor_pre_test or 'null'}}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
									    <h3 class="panel-title"><strong>Post-Test Score</strong></h3>
									</div>
									<div class="panel-body" style="font-size: 100px;">
									    {{$skor_post_test or 'null'}}
									</div>
								</div>
							</div>
						</div>
						
						<br>
						<h6>
						
							<a class="btn darkgreen" href="/section-training/{{$next_section->id}}">Next</a>
						
						</h6>
						
					</div>
				</div>
				</section>
		</div>				
	@endif
			</div>	
				

	
	<!-- Modul -->
	@include('layouts.footer')
	</div>

	@include('layouts.script')
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    //cant back
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

    //cant right click
    document.addEventListener('contextmenu', event => event.preventDefault());
    //keyboard not run
    document.onkeydown = function (e) {
	        return false;
	}
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

