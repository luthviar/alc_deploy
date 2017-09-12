@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/>  <input type="radio" name="isTrue"/>  <a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

<!--Form to Create New Trainning -->
		Create Trainning
		<br><br>
		<div class="w3-border" style="border-radius:5px">
			<div class="w3-green" style="height:24px;width:20%;text-align:center;border-radius:5px">20%</div>
		</div>
		<BR>
	
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create PreTest</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
						
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Question</label>

                            <div class="col-md-6">
                                <textarea id="username" placeholder="Trainning Title" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
								</textarea>
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Option</label>

                            <div class="col-md-6">
								<i class="fa fa-exclamation-triangle" aria-hidden="true" style="color:orange"></i>Choose correct answer by click the button beside option field<br><br>
								<div><input type="text" name="mytext[]"/>
								<span><input type="radio" name="isTrue"/></span><br><br></div>
								<div><input type="text" name="mytext[]"/>
								<span><input type="radio" name="isTrue"/></span><br><br></div>
								<div class="input_fields_wrap"></div>
   							    <button class="add_field_button">Add More Option</button>
                            </div>
						
						<br>
						
                            </div>
							
							 
  </div>
					
  
</div>

<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   Add New Question
                                </button>
                            </div>
                        </div>
					<br><br>
					<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Next Step
                                </button>
                            </div>
                        </div>
</br>
</br>

@endsection