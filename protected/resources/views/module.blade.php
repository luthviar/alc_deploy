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
    </div>
    <!-- Header -->
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
					<li class="classic-menu-dropdown active">
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
					</a>
				</li>
				<li class=""><a href="/news-board">News</a></li>
				@if(Auth::user())
				<li class=""><a href="{{url('/forum')}}">Forum</a></li>
				<li class="classic-menu-dropdown active">
					<a>
						My Modules <i class="arrow fa fa-angle-down"></i>
						<span class="selected">
						</span>
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
                <div class="block-advice">
                    <div class = "text-center">
                    	<h2 class="brand-before">
                            <small>Welcome to</small>
                        </h2>
                        <h1 class="brand-name">{{ $aktif_modul->nama }}</h1>
                        
                        <hr class="tagline-divider">
                        <p align="justify">    
                                {{ $aktif_modul['description'] }}
                        </p>   
                    </div>
                    <div class="row">
		                <hr class="style3">
		            </div>
		            <div class="row">

                    	<h2>Training Modul {{$aktif_modul->nama}}</h2>
                    	<br>
					
						@if($aktif_modul->id == 3)
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  		@foreach($department as $dep)
					  		<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
						  			<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1{{$dep->id_department}}" aria-expanded="true" aria-controls="#collapse1{{$dep->id_department}}">
								  		{{ $dep->nama_departmen}}
								  			<span class="pull-right">
								  				<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
								  			</span>
										</a>
						  			</h4>
								</div>
								
								<div id="collapse1{{$dep->id_department}}" class="panel-collapse collapse">
							  		<div class="panel-body">
										<ul class="list-group">
											@foreach($training as $trains)
												@if($trains->id_department == $dep->id_department)
													@if($trains['open'] == 1)
														<li class ="list-group-item">
															<a href="/training/{{$trains->id}}">
																<h5>{{$trains->title}}
																	<span class="pull-right">  
																		<i class="fa fa-check-square-o" style="color:green;" aria-hidden="true"></i>
																	</span>
																</h5>
															</a>
														</li>
													@else
														<li class ="list-group-item">
															<a href="/training/{{$trains->id}}">
																<h5>{{$trains->title}}
																	<span class="pull-right">  
																		<i class="fa fa-window-close-o" style="color:red;" aria-hidden="true"></i>
																	</span>
																</h5>
															</a>
														</li>
													@endif
												@endif
											@endforeach
										</ul>
							  		</div>
								</div>
						  	</div>
						  	@endforeach
						</div>
					
						@elseif($aktif_modul->id == 4 or $modul->id == 5)
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								@foreach($training as $trains)
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
									  		<h4 class="panel-title">
									
											@if($trains['open'] == 1)
												<a href="/training/{{$trains->id}}">
													{{$trains->title}}
													<span class ="pull-right">  <i class="fa fa-check-square-o" style="color:green;" aria-hidden="true">
													</i></span>
												</a>
											@else
												<a href="/training/{{$trains->id}}"><h5>{{$trains->title}}<span class ="pull-right">  <i class="fa fa-window-close-o" style="color:red;" aria-hidden="true"></span></i></h5></a>
											@endif 									
											</h4>
								  		</div>
									</div>
								@endforeach 
					  		</div>
      					@else
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								@foreach($training as $trains)
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
										  	<h4 class="panel-title">
									     	<a href="/training/{{$trains->id}}">{{$trains->title}}</a></h4>
									    </div>
									</div>
								@endforeach						
							</div>
						@endif
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

