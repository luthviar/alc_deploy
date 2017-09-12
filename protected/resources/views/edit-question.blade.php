@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

@php
	$count = 0
@endphp
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-success">
            <div class="panel-heading">Edit Question</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/question/edit/submit">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_question" value="{{$question->id}} ">
                        <input type="hidden" name="" id="jumlah_opsi" value="{{count($question['opsi'])}}">

						<div class="form-group">					
							<label for="question" class="col-md-4 control-label">Question</label>
					
							<div class="col-md-6">
								<textarea id="summernote" name="question" required="true">{{$question->pertanyaan}}</textarea>
							</div>
						</div>
								
						<div class="form-group">
							<label for="opsi" class="col-md-4 control-label">Option</label>
							
							<div class="row">
								<div class="col-lg-6">
									<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>

									<div class="input_fields_wrap">
									@foreach($question['opsi'] as $opsi)
										@if($count < 2)
											<div>
												<input type="text" name="opsi[]" value="{{$opsi->isi_opsi}}" />
												<span>
												@if($opsi->is_true == 1)
													<input type="radio" name="isTrue" value="{{$count}}" checked required="true" />
												@else
													<input type="radio" name="isTrue" value="{{$count}}" required="true" />
												@endif
												</span><br><br>
											</div>
											<?php $count += 1 ?>
										
										@else

												@if($opsi->is_true == 1)
												<div>
													<input type="text" name="opsi[]" value="{{$opsi->isi_opsi}}" />
													<input type="radio" name="isTrue" value="{{$count}}" checked required="true" /> 
													<a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a>
													<br><br>
												</div>
												@else
												<div>
													<input type="text" name="opsi[]" value="{{$opsi->isi_opsi}}" />
													<input type="radio" name="isTrue" value="{{$count}}" required="true" /> 
													<a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a>
													<br><br>
												</div>
												@endif
											<?php $count += 1 ?>
										@endif

									@endforeach
									
									
									</div>
									
									<button class="add_field_button">Add More Option</button>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="time" class="col-md-4 control-label"></label>
                            <div class="col-md-4">          
							   <button  class="btn btn-default">Submit</button>
                            </div>
                        </div>
                        <div id="coba">
                        	
                        </div>
                    </form>						
                </div>
            </div>
        </div>
  	</div>
</div>

<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var count 			= $('#jumlah_opsi').val();
    count				= parseInt(count) + 1;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="opsi[]"/>  <input type="radio" name="isTrue" required="true" value="'+count+'"/>  <a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
            count+=1;
        }
        
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
        count-=1;
        
    });

    
});
</script>

@endsection