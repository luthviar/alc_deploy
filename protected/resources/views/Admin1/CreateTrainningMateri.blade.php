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
		<BR>
	
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Materi</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Add Materi</label>

                            <div class="col-md-6">
							<div><span> bla.bla.pdf <i class="fa fa-times" aria-hidden="true"></i></span></div>
							<div><span> bla.bla.pdf <i class="fa fa-times" aria-hidden="true"></i></span></div><br>
                                <button type="submit" class="btn btn-white">
                                    Add Materi
                                </button>
                            </div>
                        </div>
						
							
						
  </div>
</div>

						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Next Step
                                </button>
                            </div>
                        </div>

@endsection