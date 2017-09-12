@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<!--Form to Create New Trainning -->
		<div class="row">
	        <div class="col-md-12 ">
	            <div class="panel panel-default">
	                <div class="panel-heading">Create PostTest</div>
		                <div class="panel-body">
		                    <form class="form-horizontal" role="form" method="POST" action="/post-test/submit">
		                        {{ csrf_field() }}		                            
		                        <input type="hidden" name="id_training" value="{{$id_training or null}} ">
		                        <input type="hidden" name="id_type" value="3">
								<div class="form-group">
		                            <label for="time" class="col-md-4 control-label">PostTest Duration</label>
		                            <div class="col-md-4">
		                            	@if($time==0)
		                                <input id="time" placeholder="In Minutes" type="number" class="form-control" name="time" min="1" required autofocus>
		                                @else
		                                <input id="time" placeholder="In Minutes" type="number" class="form-control" name="time" value="{{ $time }}" required autofocus readonly="true">
		                                @endif
		                            </div>
		                        </div>
								
								<div class="form-group">
									<label for="time" class="col-md-4 control-label"></label>
		                            <div class="col-md-4">          
									   <button  class="btn btn-default">Submit</button>
		                            </div>
		                        </div>
		                    </form>						
		                </div>
		            </div>
		        </div>
		  	</div>
		</div>



<!--Add Question -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Question</h4>
		  </div>
		  <div class="modal-body">
			
					
						<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('QuestionController@store') }}">
							{{ csrf_field() }}

							<input type="hidden" name="id_training" value="{{$id_training}}">
							<input type="hidden" name="id_test" value="{{$id_test or null}}">
							<input type="hidden" name="time" value="{{$time or null}}">
							
							
							<div class="form-group">
								<label for="question" class="col-md-4 control-label">Question</label>
						
								<div class="col-md-6">
									<textarea id="summernote" name ="question"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="opsi" class="col-md-4 control-label">Option</label>
								<div class="row">
								<div class="col-lg-6">
									<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>
									<div>
									<input type="text" name="opsi[]"/>
									<span><input type="radio" name="isTrue" value="0" required="true" /></span><br><br>
									</div>
									<div>
									<input type="text" name="opsi[]"/>
									<span><input type="radio" name="isTrue" value="1" required="true"/></span><br><br>
									</div>
									<div class="input_fields_wrap">
									</div>
									<button class="add_field_button">Add More Option</button>
								</div>
								</div>
							</div>
							<br>
					
				
			 
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
  
  @if($time!=0)  
  <!--Table -->
  <div class="col-md-12 ">
    <div class="panel panel-default">
		<div class="panel-heading">Question List</div>
		<div class="panel-body">
		<div class = "main-table">
		<button  class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Question</button><br><br>
			<table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th width="60%">Question</th>
				  <th width="20%">Answer</th>
				  <th width="20%">Edit</th>
				</tr>
			  </thead>
			  <tbody>
			  	@if(empty($questions))
			  	@else
				  	@foreach($questions as $question)
					<tr>
					  <td>{{$question->pertanyaan}}</td>
					  @foreach($question['opsi'] as $opsi)
					  	@if($opsi->is_true == 1)
					  		<td>{{$opsi->isi_opsi}}</td>
					  	@endif
					  @endforeach
					  <td><button  data-toggle="modal" data-target="#Edit">
					  <span ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>Edit </button></td>
					</tr>
					@endforeach
				@endif
			  </tbody>
			</table>
			</div>
		</div>
	</div>
	<a class="btn btn-primary" href="/training">Finish</a>
</div>
@endif


<!--Edit Question -->
<div class="modal fade" id="Edit" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" >
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Add Question</h4>
		  </div>
		  <div class="modal-body">
			
					
						<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
							{{ csrf_field() }}
							
							<div class="form-group">
								<label for="username" class="col-md-4 control-label">Question</label>
						
								<div class="col-md-6">
									<textarea id="username" placeholder="Trainning Title" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

									</textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label for="username" class="col-md-4 control-label">Option</label>
								<div class="row">
								<div class="col-lg-6">
									<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>
									<div>
									<input type="text" name="mytext[]"/>
									<span><input type="radio" name="isTrue"/></span><br><br>
									</div>
									<div>
									<input type="text" name="mytext[]"/>
									<span><input type="radio" name="isTrue"/></span><br><br>
									</div>
									<div>
									<input type="text" name="mytext[]"/>
									<span><input type="radio" name="isTrue"/></span><br><br>
									</div>
									<div>
									<input type="text" name="mytext[]"/>
									<span><input type="radio" name="isTrue"/></span><br><br>
									</div>
									<div class="input_fields_wrap">
									</div>
									<button class="add_field_button">Add More Option</button>
								</div>
								</div>
							</div>
							<br>
					
				
			 
		  </div>
    
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" value="submit">Submit</button>
		 </div>
		 </form> 			
					

      </div>
      
    </div>
  </div>


  

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var count           = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="opsi[]"/>  <input type="radio" required="true" name="isTrue" value="'+count+'"/>  <a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
            count+=1;
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

@endsection