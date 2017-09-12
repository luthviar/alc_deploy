@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<!--Form to Create New Trainning -->


<div class="col-md-12">
   <div class="panel panel-default">
     <div class="panel-heading">Content Learning</div>
       <div class="panel-body">

        <div class = "main-table">
            <div class="row">
                <div class="container">
                    <a class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Content Learning</a><br><br>
                </div>
            </div>
            <br>
            <table id= "detailTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Content Title</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($contents))
                    @else
                        @foreach($contents as $content)
                        <tr>
                            <td>{{$content->file_name}}</td>
                            <td><a href="{{URL::asset($content->url)}}">view</a></td>
                            <td><a class="btn btn-default" href="#">edit</a></span></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>                
        <a href="/add-post-test/{{$id_training}}" class="btn btn-info">Next</a>
	 </div>
	</div>
</div>


<!-- MODAL - Add Content Learning -->
<div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ContentLearningController@store') }}" enctype="multipart/form-data"">
        <!-- Modal content-->
      <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Content Learning</h4>
            </div>
            <div class="modal-body">                                       
                {{ csrf_field() }}
                <input type="hidden" name="id_section" value="{{$id_section or null}}">
                            
                <div class="form-group">
                    <label for="file_name" class="col-md-4 control-label">Content Title</label>
                    <div class="col-md-6">
                        <input id="file_name" type="text" class="form-control" placeholder="Content Learning Title" name="file_name"  required autofocus>
                    </div>
                </div>
                            
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> 
                            <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="Application/pdf" name="file"/> <!-- rename it -->
                                </div>
                            </span>
                        </div><!-- /input-group image-preview [TO HERE]--> 
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="{{ URL::asset('css/Upload2.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg2.js')}}"></script>


<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>



@endsection