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
                    <li>
                    	<a style="margin-top:10px;" class="btn btn-small btn-sm pull-right hijau-muda" href="{{ route('login') }}">Login <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a>
                    </li>
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
					<li class="classic-menu-dropdown">
						<a href="/news-board">News</a>
					</li>
					@if(Auth::user())
					<li class="classic-menu-dropdown">
						<a href="{{url('/forum')}}">Forum</a>
					</li>
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
       <div class="page-content-wrapper"> 
	@if(empty($logout))
            {{--kalau true, masuk sini, artinya belum pernah dan post test--}}
        <div class="page-content" style="">	
		<section id="main">
            <div class="container" style="margin-top: 30px;">
				<div class="row">
				
					<div class="btn-group btn-breadcrumb">
						<a  class="btn btn-default">Introduction</a>
						<a  class="btn btn-default">Pre-Test</a>
						<a  class="btn btn-success">Modul</a>
						<a  class="btn btn-default">Post-Test</a>
					</div>
				</div>
	   
			</div>
			<br>
			<div class="block-advice">
					<div class="text-center">
					<h2 class="brand-before">
							<small>{{$training->title}}</small>
						</h2>
						<h1 class="brand-name">Materi Training</h1>
					</div>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						@foreach($content as $materi)
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$materi->id}}" aria-expanded="false" aria-controls="collapseOne">
						          {{$materi->file_name}}
						        </a>
						      </h4>
						    </div>
						    <div id="collapseOne{{$materi->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">

						      <div class="panel-body">
						      	<div>{!! html_entity_decode($materi->description) !!}</div>
						      	<hr>
						        <iframe id="viewer"
										src = "{{URL::to($materi->url)}}"
										width='100%'
										height='600'
										allowfullscreen webkitallowfullscreen>
								</iframe>

						      </div>
						    </div>
						  </div>
						  @endforeach
						</div>
							
						
						<br>
						<div class="text-center">
						<h6>
							
							
							<a class="btn darkgreen" href="/section-training/{{$next_section->id}}">Next</a>
							
							
						</h6>
						</div>
						
					
				</div>
				<section>
        </div>
        	
	@else
			   <div class="page-content" style="">
		   <section id="main">
				   <div class="container" style="margin-top: 30px;">
					   <div class="row">
						   <div class="btn-group btn-breadcrumb">
							   <a  class="btn btn-default">Introduction</a>
							   <a  class="btn btn-default">Pre-Test</a>
							   <a  class="btn btn-success">Modul</a>
							   <a  class="btn btn-default">Post-Test</a>
						   </div>
					   </div>
				   </div>
				   <br>
				   
				   <!--
				   <div class="page-content" style="">
            <div class="container">
				<div class="row">

					{{--<div class="btn-group btn-breadcrumb">--}}
						{{--<a  class="btn btn-default">Introduction</a>--}}
						{{--<a  class="btn btn-default">Pre-Test</a>--}}
						{{--<a  class="btn btn-success">Modul</a>--}}
						{{--<a  class="btn btn-default">Post-Test</a>--}}
					{{--</div>--}}
				</div>

			</div>
			<br>-->
			
			<div class="block-advice">
					<div class="text-center">
					<h2 class="brand-before">
							<small>{{$training->title}}</small>
						</h2>
						<h1 class="brand-name">Materi Training</h1>
					</div>
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						@foreach($content as $materi)
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
						      <h4 class="panel-title">
						        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$materi->id}}" aria-expanded="false" aria-controls="collapseOne">
						          {{$materi->file_name}}
						        </a>
						      </h4>
						    </div>
						    <div id="collapseOne{{$materi->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">

						      <div class="panel-body">
						      	<div>{!! html_entity_decode($materi->description) !!}</div>
						      	<hr>
						        <iframe id="viewer"
										src = "{{URL::to($materi->url)}}"
										width='100%'
										height='600'
										allowfullscreen webkitallowfullscreen>
								</iframe>

						      </div>
						    </div>
						  </div>
						  @endforeach
						</div>
							
						
						<br>
						<div class="text-center">
						<h6>
							
							<a class="btn btn-warning" href="/module/{{$training->id_module}}">Back</a>
							<a class="btn darkgreen" href="/section-training/{{$next_section->id}}">See Result</a>
							
							
						</h6>
						</div>
						
					
				</div>
        <!--</div>-->
		</section>
        </div>
		@endif
	</div>
	 <!-- Footer -->
        @include('layouts.footer')
    </div>

    @include('layouts.script')

<!-- Modal fullscreen -->
<div class="modal modal-fullscreen fade" id="modal_content" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" aria-hidden="true">
	<div class="modal-dialog">
  		<div class="modal-content">	
			<div class="modal-header">
  				<h4 class="modal-title" id="myModalLabel">Aerofood Learning Center</h4>
			</div>
			<div class="modal-body">
  				<div id="file">
  					<!-- content learning here -->
  				</div>
			</div>
  		</div>
	</div>

</div>


</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, document.URL);
    });

    document.addEventListener('contextmenu', event => event.preventDefault());
    //keyboard not run
    document.onkeydown = function (e) {
	        return false;
	}
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('iframe').ready(function() {
	   setTimeout(function() {
	      $('iframe').contents().find('#download').remove();
	   }, 100);
	});
});
</script>

<style type="text/css">
/* .modal-fullscreen */
.modal-fullscreen {
  background: white;
}
.modal-fullscreen .modal-content {
  background: transparent;
  border: 0;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.modal-backdrop.modal-backdrop-fullscreen {
  background: #ffffff;
}
.modal-backdrop.modal-backdrop-fullscreen.in {
  opacity: .97;
  filter: alpha(opacity=97);
}
/* .modal-fullscreen size: we use Bootstrap media query breakpoints */
.modal-fullscreen .modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
}
@media (min-width: 768px) {
  .modal-fullscreen .modal-dialog {
    width: 750px;
  }
}
@media (min-width: 992px) {
  .modal-fullscreen .modal-dialog {
    width: 970px;
  }
}
@media (min-width: 1200px) {
  .modal-fullscreen .modal-dialog {
     width: 1170px;
  }
}
/* centering styles for jsbin */
html,
body {
  width:100%;
  height:100%;
}
html {
  display:table;
}
body {
  display:table-cell;
  vertical-align:middle;
}
body > .btn {
  display: block;
  margin: 0 auto;
}
</style>

<script type="text/javascript">
  // .modal-backdrop classes
$(".modal-transparent").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-transparent");
  }, 0);
});
$(".modal-transparent").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-transparent");
});
$(".modal-fullscreen").on('show.bs.modal', function () {
  setTimeout( function() {
    $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
  }, 0);
});
$(".modal-fullscreen").on('hidden.bs.modal', function () {
  $(".modal-backdrop").addClass("modal-backdrop-fullscreen");
});
  
</script>
<script type="text/javascript">

 function see_content($url){
 	var html = '<iframe src="'+$url+'"></iframe>';
 	$('#file').html(html);
 	$('#modal_content').modal("show");
 }
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
