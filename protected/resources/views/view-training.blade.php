@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

	<div class="col-md-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4>Trainning Overview</h4>
        </div>
        <div class="panel-body">

        
            
                <!-- Info training -->
                <div class=" col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 "> 
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td width="30%">Trainning Name</td>
                                <td width="70%">{{$training->title}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                @if($training->is_publish == 1)
                                    <td>published <a class="pull-right" href="/trainee/{{$training->id}}">see_trainee</a></td>
                                @else
                                    <td>not published</td>
                                @endif
                            </tr>
                            <tr>
                                <td >Modul</td>
                                <td>{{$training['module']->nama}}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>{{$training['department']->nama_departmen or 'All department'}}</td>
                            </tr>
                            <tr>
                                @if($training->id_module == 4)
                                <td>Positition</td>
                                <td>Manager or up</td>
                                @else
                                <td>Positition</td>
                                <td>All Employee</td>
                                @endif
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{!! html_entity_decode($training->description) !!}</td>
                            </tr>

                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <a href="/training/{{$training->id}}/edit" class="btn btn-warning">Edit Training Info</a>
                    </div>
                    <br>
                </div>
                <!-- Info Pre Test Training -->
                <div class=" col-md-6  col-lg-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4>Pre Test Overview</h4>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>Tot. Questions</td>
                                        <td>{{$training['pretest']->jumlah_soal or '0'}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Time (minutes)</td>
                                        <td>{{$training['pretest']->time or '-'}} minutes </td>
                                        <td><a href="" data-toggle="modal" data-target="#time-pre-test"><span class="glyphicon glyphicon-edit"></span> Edit </a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" >
                                <div class="col-md-6 col-lg-6">
                                    <strong>Question List</strong>
                                </div>

                                <!-- if test time not null, question show-->
                                @if(!empty($training['pretest']->time))
                                    <div class="col-md-6 col-lg-6" style="text-align: right; ">
                                        <a href="" data-toggle="modal" data-target="#add-question-pretest"><span class="glyphicon glyphicon-plus"></span> new_question </a>
                                    </div>
                                @endif
                            </div><br>
                            
                            
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>True Answer</th>
                                            <th>Edit</th>
                                            <th>Detele</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($training['pretest-question']))

                                            @foreach($training['pretest-question'] as $question)
                                            <tr>
                                                <td>{{$question->pertanyaan}}</td>
                                                @foreach($question['opsi'] as $opsi)
                                                    @if($opsi->is_true ==1)
                                                    <td>{{$opsi->isi_opsi}}</td>
                                                    @endif
                                                @endforeach
                                                <td><a href="/question/{{$question->id}}/edit"><span class="glyphicon glyphicon-edit"></span> Edit </a></td>
                                                <td><a href="/question/delete/{{$question->id}}"><span class="glyphicon glyphicon-trash"></span> Delete </a></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Info Post Test Training -->
                <div class=" col-md-6  col-lg-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4>Post Test Overview</h4>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>Tot. Questions</td>
                                        <td>{{$training['posttest']->jumlah_soal or '0'}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Time (minutes)</td>
                                        <td>{{$training['posttest']->time or '-'}} minutes</td>
                                        <td><a href="" data-toggle="modal" data-target="#time-post-test"><span class="glyphicon glyphicon-edit"></span> Edit </a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row" >
                                <div class="col-md-6 col-lg-6">
                                    <strong>Question List</strong>
                                </div>
                                
                                <!-- if test time not null, question show-->
                                @if(!empty($training['posttest']->time))
                                    <div class="col-md-6 col-lg-6" style="text-align: right; ">
                                        <a href="" data-toggle="modal" data-target="#add-question-posttest"><span class="glyphicon glyphicon-plus"></span> new_question </a>
                                    </div>
                                @endif
                            </div><br>
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Edit</th>
                                            <th>Detele</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($training['posttest-question']))
                                            @foreach($training['posttest-question'] as $question)
                                            <tr>
                                                <td>{{$question->pertanyaan}}</td>
                                                @foreach($question['opsi'] as $opsi)
                                                    @if($opsi->is_true ==1)
                                                    <td>{{$opsi->isi_opsi}}</td>
                                                    @endif
                                                @endforeach
                                                <td><a href="/question/{{$question->id}}/edit"><span class="glyphicon glyphicon-edit"></span> Edit </a></td>
                                                <td><a href="/question/delete/{{$question->id}}"><span class="glyphicon glyphicon-trash"></span> Delete </a></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Content Learning Training -->
                <div class=" col-md-12  col-lg-12"> 
                    <div class="panel panel-info">
                        <div class="panel-heading">
                          <h4>Content Learning Overview</h4>
                        </div>
                        <div class="panel-body">
                            <div>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#add-content">Add New Content</a>
                            </div><br>
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Preview</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($training['content']))
                                            @foreach($training['content'] as $content)
                                            <tr>
                                                <td>{{$content->file_name}}</td>
                                                <td><a class="btn btn-flat" onclick="get_preview({{$content->id}})" ><span class="glyphicon glyphicon-fullscreen"></span> Preview </a></td>
                                                <td><a href="/content-learning/delete/{{$content->id}}"><span class="glyphicon glyphicon-trash"></span> Delete </a></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- .....................preview..................... -->
<div class="modal fade" id="previewmodal" role="dialog">
    <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form" method="POST" action="/content-learning/add-content" enctype="multipart/form-data"">
        <!-- Modal content-->
      <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="previewtitle"></h4>
            </div>
            <div class="modal-body">                                       
                <p id="descriptionpreview"></p>
                <a id="previewfile" href="" >file content</a>
                
            </div>
        </form>            
    </div>
</div>
        </div>
    </div>

<!-- MODAL for Add Question Pre Test -->
<div class="modal fade" id="add-question-pretest" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content" >
          
            <form class="form-horizontal" role="form" method="POST" action="/question/submit">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Question</h4>
                </div>
              
                <div class="modal-body">        
                            
                    {{ csrf_field() }}

                    <input type="hidden" name="id_training" value="{{$training->id}}">
                    <input type="hidden" name="id_test" value="{{$training['pretest']->id or null}}">
                            
                            
                    <div class="form-group">
                        <label for="question" class="col-md-4 control-label">Question</label>
                
                        <div class="col-md-6">
                            <textarea id="question" placeholder="Trainning Title" type="text" class="form-control" name="question" required autofocus>

                            </textarea>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label for="opsi" class="col-md-4 control-label">Option</label>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>
                                <div>
                                    <input type="text" name="opsi[]"/>
                                    <span>
                                        <input type="radio" name="isTrue" value="0" required="true" />
                                    </span><br><br>
                                </div>
                                
                                <div>
                                    <input type="text" name="opsi[]"/>
                                    <span>
                                        <input type="radio" name="isTrue" value="1" required="true"/>
                                    </span><br><br>
                                </div>
                                
                                <div class="input_fields_wrap">
                                
                                </div>
                                
                                <button class="add_field_button btn btn-default">Add More Option</button>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>             
        </div>
    </div>
</div>

<!-- MODAL for Add Question Post Test -->
<div class="modal fade" id="add-question-posttest" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content" >
          
            <form class="form-horizontal" role="form" method="POST" action="/question/submit">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Question</h4>
                </div>
              
                <div class="modal-body">        
                            
                    {{ csrf_field() }}

                    <input type="hidden" name="id_training" value="{{$training->id}}">
                    <input type="hidden" name="id_test" value="{{$training['posttest']->id or null}}">
                            
                            
                    <div class="form-group">
                        <label for="question" class="col-md-4 control-label">Question</label>
                
                        <div class="col-md-6">
                            <textarea id="question" placeholder="Trainning Title" type="text" class="form-control" name="question" required autofocus>

                            </textarea>
                        </div>
                    </div>
                            
                    <div class="form-group">
                        <label for="opsi" class="col-md-4 control-label">Option</label>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>
                                <div>
                                    <input type="text" name="opsi[]"/>
                                    <span>
                                        <input type="radio" name="isTrue" value="0" required="true" />
                                    </span><br><br>
                                </div>
                                
                                <div>
                                    <input type="text" name="opsi[]"/>
                                    <span>
                                        <input type="radio" name="isTrue" value="1" required="true"/>
                                    </span><br><br>
                                </div>
                                
                                <div class="input_fields_wrap_post">
                                
                                </div>
                                
                                <button class="add_field_button_post btn btn-default">Add More Option</button>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>             
        </div>
    </div>
</div>


<!-- MODAL for Edit Pre Test's Time -->
<div class="modal fade" id="time-pre-test" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content" >
          
            <form class="form-horizontal" role="form" method="POST" action="/change-time">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit PreTest Time</h4>
                </div>
              
                <div class="modal-body">        
                            
                    {{ csrf_field() }}

                    <input type="hidden" name="id_test" value="{{$training['pretest']->id or null}}">        
                    <input type="hidden" name="id_training" value="{{$training->id}}">
                    <input type="hidden" name="id_type" value="1">        
                            
                    <div class="form-group">
                        <label for="question" class="col-md-5 control-label">Test Time (minutes) </label>
                
                        <div class="col-md-4">
                               <input class="form-control" type="number" name="time" value="{{$training['pretest']->time or null}}" placeholder="in minutes" min=1  required="true">
                        </div>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>             
        </div>
    </div>
</div>

<!-- MODAL for Edit Post Test's Time -->
<div class="modal fade" id="time-post-test" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
        <div class="modal-content" >
          
            <form class="form-horizontal" role="form" method="POST" action="/change-time">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit PostTest Time</h4>
                </div>
              
                <div class="modal-body">        
                            
                    {{ csrf_field() }}

                    <input type="hidden" name="id_training" value="{{$training->id}}">
                    <input type="hidden" name="id_test" value="{{$training['posttest']->id or null}}">        
                    <input type="hidden" name="id_type" value="3">        
                            
                    <div class="form-group">
                        <label for="question" class="col-md-5 control-label">Test Time (minutes) </label>
                
                        <div class="col-md-4">
                               <input class="form-control" type="number" name="time" value="{{$training['posttest']->time or null}}" placeholder="in minutes" min=1 required="true" >
                        </div>
                    </div>
                    
                </div>
    
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>             
        </div>
    </div>
</div>

<!-- MODAL - Add Content Learning -->
<div class="modal fade" id="add-content" role="dialog">
    <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form" method="POST" action="/content-learning/add-content" enctype="multipart/form-data"">
        <!-- Modal content-->
      <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Content Learning</h4>
            </div>
            <div class="modal-body">                                       
                {{ csrf_field() }}
                <input type="hidden" name="id_training" value="{{$training->id}}">
                            
                <div class="form-group">
                    <label for="file_name" class="col-md-2 control-label">Content Title</label>
                    <div class="col-md-8">
                        <input id="file_name" type="text" class="form-control" placeholder="Content Learning Title" name="file_name"  required="true">
                    </div>
                </div>

                <div class="form-group">
                    <label for="file_name" class="col-md-2 control-label">Description</label>
                    <div class="col-md-8">
                        <textarea id="summernote" name="description"></textarea>
                    </div>
                </div>
                            
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="imgInp" name="file" accept="Application/pdf">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div></br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>            
    </div>
</div>
<!--Detail Trainning-->
<link rel="stylesheet" href="{{ URL::asset('css/EditProfile.css')}}" />
<script type="text/javascript" src="js/EditProfile.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.detailTable').DataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
</script>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper_pre         = $(".input_fields_wrap"); //Fields wrapper
    var add_button_pre      = $(".add_field_button"); //Add button ID
    var wrapper_post         = $(".input_fields_wrap_post"); //Fields wrapper
    var add_button_post      = $(".add_field_button_post"); //Add button ID
    var count_pre            = 2;
    var count_post            = 2;

    var x_pre = 1; //initlal text box count
    var x_post = 1; //initlal text box count
    $(add_button_pre).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_pre < max_fields){ //max input box allowed
            x_pre++; //text box increment
            $(wrapper_pre).append('<div><input type="text" name="opsi[]"/>  <input type="radio" name="isTrue" required="true" value="'+count_pre+'"/>  <a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
            count_pre+=1;
        }

    });
    
    $(wrapper_pre).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_pre--;
        count_pre-=1;
    });

    $(add_button_post).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_post < max_fields){ //max input box allowed
            x_post++; //text box increment
            $(wrapper_post).append('<div><input type="text" name="opsi[]"/>  <input type="radio" name="isTrue" required="true" value="'+count_post+'"/>  <a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
            count_post+=1;
        }

    });
    
    $(wrapper_post).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_post--;
        count_post-=1;
    });

});
</script>












<script type="text/javascript">
    function get_preview($id_content){
        var id_content = $id_content;
        $.ajax({
            type:"POST",
            url:"/get-content-preview",
            dataType: 'json',
            data:{id_content:id_content,_token: '{{csrf_token()}}'},
            beforeSend: function (xhr) {
                  var token = $('meta[name="csrf_token"]').attr('content');

                  if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                  }
              },
            success: function(content) {
                
                $('#previewtitle').html(content['content']['file_name']);
                $('#descriptionpreview').html(content['content']['description']);
                $('#previewfile').attr('href',content['content']['url']);
                
                $("#previewmodal").modal('show');
            },
            error: function(content){
                console.log(JSON.stringify(content));
            },
        });
    }
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>


<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>









@endsection