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
                    <li class="classic-menu-dropdown active">
						<a href="/">
							 Home
							<span class="selected">
							</span>
						</a>
					</li>
					<li class="classic-menu-dropdown"><a href="/news-board">News</a></li>
					@if(Auth::user())
					<li class="classic-menu-dropdown"><a href="{{url('/forum')}}">Forum</a></li>
					<li class="classic-menu-dropdown">
						<a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="#">
							My Modules <i class="fa fa-angle-down"></i>
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
	    <!-- Responsive Toogle -->
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
        <div class="page-content-wrapper">
                <!-- Slider -->
    			<!-- <hr class="style13"> -->
                <div class="promo" >
                    <ul class="slider">
                        @foreach ($slider as $slide)

                        <li style="background: url({{$slide->image or 'Elegantic/images/ALS.jpg'}}) no-repeat 100% 100%; width:100% !important;">

                            <div class="slide-holder">
                                <div class="slide-info">
                                    <h1>{{$slide->title}}</h1>
                                    <p>{!! html_entity_decode(str_limit($slide->content, $limit = 360, $end = '...')) !!}</p>
									<div class="top-left">
										<a class="btn btn-ghost"  href="/slider/{{$slide->id}}">Read More</a>
									</div>
								</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    
                </div>
            <div class="clearfix"></div>
             <!-- NEWS -->
            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">

                <div class="blog-page">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 article-block">
                            <p class="border-panel-title-wrap"> 
                                <!-- <div class="panel-title-wrap"> -->
                                    <span class="panel-title-text">News</span>
                                <!-- </div> -->
                                
                            </p>
                           
                            @foreach ($berita as $news)
                            <div class="row" >
                                <div class="col-md-4 blog-img blog-tag-data">
                                    @if(empty($news->image))

                                        <img class="img-responsive" src="/Elegantic/images/ALS.jpg" alt="" style="width:100%;height:150px;">
                                        @else
                                        <img class="img-responsive" src="{{$news->image or 'Elegantic/images/ALS.jpg'}}" alt="" style="width:100%;height:150px;">
                                    @endif
                                    <ul class="list-inline">
                                        <li>
                                            <i class="fa fa-calendar"></i>
                                            <a href="#">
                                                {{ $news->created_at }}
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div class="col-md-8 blog-article">
                                    <h3>
                                        <a href="/news/{{$news->id}}">
                                            {{ str_limit($news->title, $limit = 50, $end = '...') }}
                                        </a>
                                    </h3>
                                    <p>
                                         {{ strip_tags(str_limit($news->content, $limit = 360, $end = '...')) }}
                                    </p>
											<a href="/news/{{$news->id}}" class="btn hijau-muda">
												 Read more <i class="m-icon-swapright m-icon-white"></i>
											</a>
	                               </div>
                            </div>
                            <hr>
                            @endforeach
                     
                            <ul class="pagination pull-right">
                                 <a href="/news-board" class="btn hijau-muda" href="page_blog_item.html">
                                         More News <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
                            </ul>
                        </div>

                        <div class="col-md-4 col-sm-6 article-block">
                            <p class="border-panel-title-wrap"> 
                                <span class="panel-title-text">Links</span>    
                            </p>
                            <div class="row">
                                <div class="col-md-12 clearfix">            
                                    <a href="#" class="btn btn-lg default" style="margin:5px 1px">
                                         IMS 
                                    </a>
                                    <a href="#" class="btn btn-lg red" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
                                         IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                    <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
                                         IMS  
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- end Div links-->
                   
                </div>
            
            </div>
            <div class="clearfix"></div>
        <!-- Footer -->
        </div>
        @include('layouts.footer')
        </div>


    @include('layouts.script')
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
</body>
</html>