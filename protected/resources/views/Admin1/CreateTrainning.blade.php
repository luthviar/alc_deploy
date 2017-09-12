@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
	$(function() {
    $('#Optionals').hide(); 
    $('#MySelect').change(function(){
        if($('#MySelect').val() == '3') {
            $('#Optionals').show(); 
        } else {
            $('#Optionals').hide(); 
        } 
    });
});
</script>


<!--Form to Create New Trainning -->
		Create Trainning
		<br><br>
		<div class="w3-border" style="border-radius:5px">
			<div class="w3-green" style="height:24px;width:0%;text-align:center;border-radius:5px"></div>
		</div>
		<br>
	
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Trainning Description</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('TrainingController@store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Module</label>                                     
                            <div class="col-md-6">
								<select name="job_family" id="MySelect" onchange="changeFunc();" class="selectpicker" data-live-search="true">
									<option value="1">Modul A</option>
									<option value="2">Modul B</option>
									<option value="3">Functional Module</option>
									<option value="4">Modul D</option>
								</select><br>
                            </div>

                            </div>
						
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Trainning Title</label>

                            <div class="col-md-6">
                                <input id="username" placeholder="Trainning Title" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Trainning Description</label>

                            <div class="col-md-6">
                                <textarea rows="4" col="50" id="password" type="password" class="form-control" name="password" required style="resize: none;">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
								</textarea>
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Enroll Key</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" placeholder="Trainning Title" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
                        <div id="Optionals" class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Select Departement</label>
							<div class="col-md-6">
								<select name="job_family" class="selectpicker" data-live-search="true">
									<option value="">Departement A</option>
									<option value="">Departement B</option>
									<option value="">Departement C</option>
									<option value="">Departement D</option>
								</select><br>
                            </div>

                            </div>
							
							 <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Next Step
                                </button>
                            </div>
                        </div>
  </div>
</div>

@endsection