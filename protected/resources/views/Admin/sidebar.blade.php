<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div style="height:16vh;" class="user-panel">
        <div class="pull-left image">
          @if(Auth::user()->get_photo() == null)
                <img src="{{URL::asset('photo.jpg')}}" class="img-circle" alt="User Image">
                @else
                <img src="{{URL::asset(Auth::user()->get_photo())}}" class="img-circle" alt="User Image">
                @endif
        </div>
        <div  class="pull-left info">
          <p>{{Auth::user()->get_nama()}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li>
          <a href="/personnel">
            <i class="fa fa-user"></i> <span>Personnel</span>
          </a>
        </li>
		    <li>
          <a href="/training">
            <i class="fa fa-book" aria-hidden="true"></i></i> <span>Training</span>
          </a>
        </li>
		    <li>
          <a href="/access">
            <i class="fa fa-universal-access" ></i> <span>Request Access</span>
            <!--<span class="pull-right-container">
              <small class="label pull-right bg-red">121</small>
			        <small class="label pull-right bg-green">100</small>
            </span>-->
          </a>
        </li>
		    <li>
          <a href="/struktur">
            <i class="fa fa-university" aria-hidden="true"></i> <span>Organizational Structure</span>
          </a>
        </li>
		    <li>
          <a href="/raport">
            <i class="fa fa-floppy-o" aria-hidden="true"></i> <span>Raport</span>
          </a>
        </li>
		    <li>
          <a href="/slider">
            <i class="fa fa-sliders aria-hidden="true"></i> <span>Slider</span>
          </a>
        </li>
		    <li>
          <a href="/news">
            <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>News</span>
          </a>
        </li>
        <li>
          <a href="/forum/list">
            <i class="fa fa-weixin" aria-hidden="true"></i> <span>Forum</span>
          </a>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  
