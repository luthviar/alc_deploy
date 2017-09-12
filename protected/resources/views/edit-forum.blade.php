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
					<li class="classic-menu-dropdown active"><a href="{{url('/forum')}}">Forum</a></li>
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
					<li class="classic-menu-dropdown"><a href="/raport/{{Auth::user()->id}}">My Profile</a></li>
					@endif
				</ul>
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
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
        <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">
            <div class="block-advice">
                <div class="" id="modal_edit_forum" role="dialog">
                    <div class="">
                        <!-- Modal content-->
                        <div class="" >
                            <form
                                    class="form-horizontal"
                                    role="form" method="POST"
                                    action="/forum/user/update"
                                    enctype="multipart/form-data">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">

                                        <a href="{{url()->previous()}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                                        Edit Your Thread</h4>
                                </div>

                                <div class="modal-body">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="id_forum" value="{{ $forum->id  }}"/>

                                    <div class="form-group">
                                        <label for="title" class="col-md-3 control-label">Title</label>

                                        <div class="col-md-6">
                                            <input type="text" id="title_edit" name="title" value="{{ $forum->title  }}"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="can_reply" id="can_reply_edit" class="col-md-3 control-label">Can Reply</label>
                                        <div class="col-md-6">
                                            <select name="can_reply" >
                                                @if($forum->can_reply == 1)
                                                    <option value="1" selected>Yes</option>
                                                    <option value="0">No</option>
                                                @else
                                                    <option value="1">Yes</option>
                                                    <option value="0" selected>No</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="content" class="col-md-3 control-label">Content</label>

                                        <div class="col-md-8">
                                            <textarea id ="summernote" name="content">{{$forum->content}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-md-3 control-label">Upload attachment</label>

                                        <div class="col-md-6">
                                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse..
                                        <input type="file"
                                               id="filetiga"
                                               onchange="javascript:updateList4()"
                                               name="file_pendukung[]"
                                               multiple/>
                                    </span>
                                </span>
                                                <input type="text" class="form-control" value="select file(s)" readonly>
                                            </div></br>
                                            <div class='file-uploaded'>
                                                <p id="attachments_edit">

                                                </p>
                                                <p>
                                                <div id="fileListtiga">

                                                </div>
                                                </p>
                                                <hr>
                                                @foreach($forum['file_pendukung'] as $file)
                                                    <a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>  {{$file->name}}</a>       <span><a href="/news_attachment_delete/{{$file->id}}" style="color: red;"><i class="fa fa-trash" aria-hidden="true"></i>delete</a></span><br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <input type="submit" class="btn btn-primary" value="Update">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</div>

@include('layouts.script')


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.detailTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

            {{-- modal edit forum --}}



            {{--modal edit forum--}}


        <script>
            updateList = function() {
                var input = document.getElementById('file');
                var output = document.getElementById('fileList');

                output.innerHTML = 'Selected file(s) <br><ul>';
                for (var i = 0; i < input.files.length; ++i) {
                    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

                }
                output.innerHTML += '</ul>';
            }

            updateList2 = function() {
                var input = document.getElementById('filedua');
                var output = document.getElementById('fileListdua');

                output.innerHTML = 'Selected file(s) <br><ul>';
                for (var i = 0; i < input.files.length; ++i) {
                    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

                }
                output.innerHTML += '</ul>';
            }

            updateList3 = function() {
                var input = document.getElementById('filetiga');
                var output = document.getElementById('fileListtiga');

                output.innerHTML = 'Selected file(s) <br><ul>';
                for (var i = 0; i < input.files.length; ++i) {
                    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

                }
                output.innerHTML += '</ul>';
            }

            updateList4 = function() {
                var input = document.getElementById('filetiga');
                var output = document.getElementById('fileListtiga');

                output.innerHTML = 'Selected file(s) <br><ul>';
                for (var i = 0; i < input.files.length; ++i) {
                    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

                }
                output.innerHTML += '</ul>';
            }
        </script>

            {{--edit forum script--}}
        <script>
            function editForum($id_edit,$title,$can_reply,$content,$attachments) {
                $("#id_forum_edit").val($id_edit);
                $("#title_edit").val($title);
                $("#can_reply_edit").val($can_reply);

                $("#summernote_edit").summernote("code", $content);
//                $("#content_edit").html($content);

                $("#attachments_edit").html($attachments);

                $('#modal_edit_forum').modal("show");
            }
        </script>
		
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
          height: 200,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor

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

</body>
</html>

