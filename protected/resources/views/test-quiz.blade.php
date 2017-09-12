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
          </a>
        </li>
        <li class=""><a href="/news-board">News</a></li>
        @if(Auth::user())
        <li class=""><a href="{{url('/forum')}}">Forum</a></li>
        <li class="classic-menu-dropdown active">
          <a>
            My Modules <i class="arrow fa fa-angle-down"></i> <span class="selected">
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
        <div class="page-content" style="">   
      <div class="container">
        <div class="row">
        <h2>Training</h2>
          <div class="btn-group btn-breadcrumb">
            <a  class="btn btn-default">Introduction</i></a>
            @if($type->id==1)
            <a  class="btn btn-success">Pre-Test</a>
            @elseif($type->id==3)
            <a  class="btn btn-default">Pre-Test</a>
            @endif
            <a  class="btn btn-default">Modul</a>
            @if($type->id==1)
            <a  class="btn btn-default">Post-Test</a>
            @elseif($type->id==3)
            <a  class="btn btn-success">Post-Test</a>
            @endif
            
          </div>
        </div>
     
      </div>
      <br>
      
      <div class="block-advice">
          <div class = "text-center">
          <h2 class="brand-before">
              <small>Induction Training</small>
            </h2>
            <h1 class="brand-name">{{$type->nama}}</h1>
            <hr class="tagline-divider">
            <h2>
            </h2><br>
              <h4>
                @if(empty($test) or empty($questions[0]))
                  
                    Tidak ada Test pada Training ini

                @elseif($pernah_test == true)

                    Anda telah melakukan test ini

                @else
                    
                    Quiz Duration = {{$test->time}} Minutes<br><br>
                    Total Question = {{$test->jumlah_soal}} Question<br><br>

                @endif
              </h4>
              <!-- Button modal fullscreen -->
              @if(empty($test) or empty($questions[0]))
                @if($type->id == 3)
                  {{--<a href="/training/{{ $ }}" class="btn btn-warning btn-flat" >Finish Test</a>--}}
                @else
                  <a href="/section-training/{{$next_section->id}}" class="btn btn-success btn-flat" >Next</a>
                @endif

              @elseif($pernah_test == true)

                <a href="/section-training/{{$next_section->id}}" class="btn btn-success btn-flat" >Next</a>

              @else
                <button type="button" class="btn btn-success btn-lg" data-keyboard="false" data-toggle="modal" data-target="#modal-fullscreen" onclick="start_timer(); start_safe();">
                  Mulai Test
                </button>
              @endif

              <!-- Modal fullscreen -->
              <div class="modal modal-fullscreen fade" id="modal-fullscreen" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <form class="" action="{{ URL::action('JawabanTraineeController@store') }}" method="post" id="myquiz" >
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}"><br>
                    <input type="hidden" name="id_test" value="{{$test->id}}"><br>
                    <div class="modal-header">
                      
                      <h4 class="modal-title" id="myModalLabel">Aerofood Learning Center</h4>
                      <div class = "timerC">Quiz End in  <span id="time"></span></div>
                    </div>
                    <div class="modal-body">
                      <table class="quizTable">
                      @foreach($questions as $question)
                      <tr>
                        <td>
                          <div class="questionDiv" align="left">
                            <p class="question">{{$question->pertanyaan}}</p>
                              @foreach($question->opsi as $opsi)
                              <div class="row" style="margin-left: 5%;">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="{{$question->id}}" id="optionsRadios1" value="{{$opsi->id}}" required>
                                    {{$opsi->isi_opsi}}
                                  </label>
                                </div>
                              </div>    
                              @endforeach
                          </div>
                        </td>
                      </tr>
                      @endforeach
                  </table>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                      <input type="submit" value="submit" onclick="submittest();" target="_blank">
                    </div> <colgroup></colgroup>

                      <script>
                          //        window.confirm("Apakah Anda yakin keluar dari halaman ini? Jika Anda keluar, maka test Anda akan ter-submit secara otomatis.");

                          //     first time ini
                          //     window.onbeforeunload = confirmExit;
                          //     function confirmExit() {
                          //      return   confirm("Apakah Anda yakin keluar dari halaman ini? Jika Anda keluar, maka test Anda akan ter-submit secara otomatis.");
                          //     }



                          //     $(window).blur(function confirmExit() {
                          ////         confirm("Apakah Anda yakin keluar dari halaman ini? Jika Anda keluar, maka test Anda akan ter-submit secara otomatis.");
                          //          return confirm("Apakah Anda yakin keluar dari halaman ini? Jika Anda keluar, maka test Anda akan ter-submit secara otomatis.");
                          //     });

                          function close_window() {
                              if (confirm("Close Window?")) {
                                  window.close();
                              }
                          }

                          function start_safe() {
                              $(window).bind("beforeunload",function(event) {
                                  return "You have some unsaved changes";
                              });
                              document.addEventListener('contextmenu', event => event.preventDefault());
//                              window.onbeforeunload = function (e) {
//                                  e = e || window.event;
//
//                                  // For IE and Firefox prior to version 4
//                                  if (e) {
//                                      e.returnValue = 'Sure?';
//                                  }
//
//                                  // For Safari
//                                  return 'Sure?';
//                              };

//                              setTimeout($(window).blur(function() {
//                                  var valz = confirm("Notice about leaving the page?" +
//                                      " " +
//                                      " " +
//                                      "Jika Anda belum keluar, maka tahan tombol esc pada keyboard dan klik terus menerus mouse Anda pada pertanyaan test');");
//                                  if(valz == false) {
//                                      if (!document.hasFocus()) {
////             if(!document.hasFocus()) {
////             if(!document.mouseenter()) {
////                 console.log("user left the page");
////             }
//                                      } else {
//                                          window.onbeforeunload = function (e) {
//                                              e = e || window.event;
//
//                                              // For IE and Firefox prior to version 4
//                                              if (e) {
//                                                  e.returnValue = 'Sure?';
//                                              }
//
//                                              // For Safari
//                                              return 'Sure?';
//                                          };
//                                      }
//                                  }}),3000);
                          }

                          //     setTimeout(function(){ alert("Hello"); }, 3000);




                      </script>

                  </form>
                  </div>

                </div>
              </div>
              {{--end of modal full screen--}}

          </div>
        </div>
    </div>

        

  </div>
  
  <!-- Modul -->
  @include('layouts.footer')
  </div>

  @include('layouts.script')
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



<!-- Quiz style -->
<style type="text/css">
p.question {
  font-family:  Arial, sans-serif;
  font-size:19px;
  color: #2E2E2E;
  margin-bottom:0px;
  margin-top:0px;
}
h2.quizHeader {
  width: 100%;
  font-family: Arial, sans-serif;
  font-weight:normal;
  font-size:25px;
  line-height: 27px;
  margin: 24px 0 12px 0;
  padding: 0 0 4px 0;
  border-bottom: 1px solid #a2a2a2;
  color : white;
}
div.quizBottomStuff {
  width: 583px;
}
div.questionDiv {
  width : auto;
  border : 1px solid green;
  padding : 2%;
  display: block !important;
}
h2.quizScore{
  width: 483px;
  font-family: Arial, sans-serif;
  font-size:25px;
  margin: 6px 0 6px 0;
}
div.quizAnswers{
  font-family: Arial, sans-serif;
  font-size:16px;
  color: #424242;
}
.addPadding {
  padding: 4px 0 4px 0;
}
label {
  font-family: Arial, sans-serif;
  font-size:14px;
  color: #424242;
  vertical-align:top;
}
input.answer[type="radio"] {
  margin-bottom: 10px;
  opacity: 1;
}
input.quizSubmit[type="submit"] {
  -webkit-background-clip: border-box;
  -webkit-background-origin: padding-box;
  -webkit-background-size: auto;
  -webkit-transition-delay: 0s, 0s;
  -webkit-transition-duration: 0.2s, 0.2s;
  -webkit-transition-property: color, background-color;
  -webkit-transition-timing-function: ease, ease;
  box-shadow: rgba(0, 0, 0, 0.498039) 0px 0px 5px 0px;
  color: #ffffff;
  background-color: #c30b0a;
  margin: 0;
  border: 0;
  outline: 0;
  text-transform:uppercase;
  height:35px;
  width:85px;
  border: 1px solid #5E5E5E;
  border-radius:5px;
  
 }
input.quizSubmit[type="submit"]:hover {
  color: #ffffff;
  background: #680f11;
  text-decoration: none;
  
}
table.quizTable {
  background-color: #F2F2F2;
  border:1px solid #BDBDBD;
  border-radius:5px;
  padding : 3%;
  width: 100%;
  box-shadow: rgba(0, 0, 0, 0.498039) 0px 0px 1px 0px;
}
th {
}
tr {
}
td {
}
ul {
  *border: 1px solid green;
  margin-bottom: 5px;
  margin-top: 10px;
}
.submitter {
    width:85px;
    float:left;
}
.hide {
    display:none;
}
.shareButton {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 9px;
  text-align:center;
  *border: 1px solid green;
  float:right;
  *width: 30px;
  *height: 15px;
  margin: 4px;
}
div.timerC{
  float : right;
  color : white;
  background-color : green;
  padding : 1%;
  border-radius : 10px;
}
/*SFS light red = #c30b0a;
SFS dark red = #9f2026; */
</style>

<!-- Quiz script-->
<script>
  function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);
        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds; 
        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }
        if (minutes < 1 && seconds < 1) {
          document.getElementById('myquiz').submit();
        }
    }
    // we don't want to wait a full second before the timer starts
    timer();
    setInterval(timer, 1000);
}
//minute
 function start_timer() {
    var fiveMinutes = 60 *{{$test->time}},
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
}
</script>

<script>
    function submittest() {
        $('#myquiz').on('submit',function(e) {
//            open(location, '_self').close();
        });
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
