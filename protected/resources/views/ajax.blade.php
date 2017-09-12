@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<div class="col-md-12 ">
	<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">General info</a></li>
    <li role="presentation"><a href="#status" aria-controls="profile" role="tab" data-toggle="tab">Employee Status</a></li>
</div>
<br><br><br>
<form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('PersonnelController@store') }}" novalidate>
	<div class="col-md-12 ">
	<div class="tab-content">
		  <div role="tabpanel" class="tab-pane active" id="info">
		<div class="panel panel-success">
    	<div class="panel-heading">
    		<h4>Add New Personnel</h4>
    	</div>
        	<div class="panel-body">
            	<form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('PersonnelController@store') }}" novalidate>
        			{{ csrf_field() }}
            		<div class="form-group">
                    	<label for="username" class="col-md-4 control-label">Username</label>
                    	<div class="col-md-6">
                        	<input id="username" type="text" class="form-control" name="username" required autofocus>
                    	</div>
                	</div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>
				
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="fname" class="col-md-4 control-label">First Name</label>

                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control" name="fname"  required autofocus>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="lname" class="col-md-4 control-label">Last Name</label>

                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control" name="lname"  required autofocus>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="jenis_kelamin" class="col-md-4 control-label">Gender</label>                                     
                        <div class="col-md-6">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="1">Laki - Laki</option>
                                <option value="0">Perempuan</option>
                            </select><br>
                        </div>
                	</div>
					
					<div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>
								
					
					<div class="form-group">
                        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="no_hp" required>
                        </div>
                    </div>
					
					<div class="form-group">
                            <label for="datePicker" class="col-md-4 control-label">Birth Date</label>
                        <div class="col-md-6 date">
                            <div class="input-group input-append date">
                                <input type="text" class="form-control" id="datepicker" name="tanggal_lahir" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>

					
					<div class="form-group">
                        <label for="alamat" class="col-md-4 control-label">Adrress</label>
                        <div class="col-md-6" >
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="is_admin" class="col-md-4 control-label">User Category</label>                                     
                        <div class="col-md-6">
                            <select name="is_admin" class="form-control">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select><br>
                        </div>
                	</div>
					
                   </div>
				  </div>
                </div>

                    <!-- Data Karyawan-->
               <div role="tabpanel" class="tab-pane" id="status">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4>Employee status</h4>
						</div>
						<div class="panel-body">
	                    <div class="form-group">
	                        <label for="nik" class="col-md-4 control-label">Employee Number</label>

	                        <div class="col-md-6">
	                            <input id="nik" type="text" class="form-control" name="nik">
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <label for="level_position" class="col-md-4 control-label">Level Position</label>                                     
	                        <div class="col-md-6">
	                            <select name="level_position" class="form-control" id="level">
									<option value="">.....</option>
	                                @foreach($level as $pos)
	                                <option value="{{$pos->id}}">{{$pos->nama_level}}</option>
	                                @endforeach
	                            </select><br>
	                        </div>
	                    </div>
                
                        <div class="form-group" id="Divisi">
                            <label for="divisi" class="col-md-4 control-label">Divition</label>                                     
                            <div class="col-md-6">
                                <select name="id_divisi" class="form-control" id="MyDivisi">
                                    <option value="">..</option>
	                                @foreach($divisi as $div)
	                                <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
	                                @endforeach
                                    
                                </select><br>
                            </div>
                        </div>
                        <div class="form-group" id="Unit">
                            <label for="divisi" class="col-md-4 control-label">Unit</label>                                     
                            <div class="col-md-6">
                                <select name="id_unit" class="form-control" id="MyUnit">
                                    
                                </select><br>
                            </div>
                        </div>
                        <div class="form-group" id="Department">
                        	<label for="divisi" class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <select name="id_department" class="form-control" id="MyDepartment">
                                    
                                </select><br>
                            </div>
                             
                        </div>
                        <div class="form-group" id="Section">
                            <label for="section" class="col-md-4 control-label">Section</label>                                     
                            <div class="col-md-6">
                                <select name="id_section" class="form-control" id="MySection">
                                    			                                
                               	</select><br>
                            </div>
                        </div>
                    </div>
					</div>
        	</div>
    	</div>
		<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Add User
									</button>
								</div>
							</div>
	</div>
</form>


<script type="text/javascript">

    $(document).ready(function(){
        $('#Unit').hide();
        $('#Department').hide();
        $('#Section').hide();
    });
        
</script>
<script type="text/javascript">
    $('#level').change(function(){
        var level = $('#level').val();
        if (level == 11) {
            $('#Divisi').hide();
            $('#Unit').hide();
            $('#Department').hide();
            $('#Section').hide();
        }else{
            $('#Divisi').show();
        }
    });
</script>
<script type="text/javascript">
    

	$('#MyDivisi').click(function() {
	  var id_divisi = $('#MyDivisi').val();
	  $.ajax({
	    type:"POST",
	    url:"/get-unit",
	    dataType: 'json',
	    data:{id_divisi:id_divisi,_token: '{{csrf_token()}}'},
	    beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
	    success: function(units) {
	    	var html = '';
	    	$.each(units.units, function(key, value){
	    		html += '<option value="'+value.id_unit+'">'+value.nama_unit+'</option>';	    		
	    		
	    	});
	    	$('#MyUnit').html(html);		
	    	$('#Unit').show();
	    	
	    },
	    error: function(data){
	    	console.log(data);
        },
	  });
	  
	});

</script>

<script type="text/javascript">


	$('#MyUnit').click(function() {
	  var id_divisi = $('#MyDivisi').val();
	  var id_unit = $('#MyUnit').val();
	  $.ajax({
	    type:"POST",
	    url:"/get-department",
	    dataType: 'json',
	    data:{id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
	    beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
	    success: function(departments) {
	    	var html = '';
	    	$.each(departments.departments, function(key, value){	    		
	    		html += '<option value="'+value.id_department+'">'+value.nama_departmen+'</option>';
	    		
	    	});
	    	$('#MyDepartment').html(html);	
	    	$('#Department').show();
	    	
	    	
	    },
	    error: function(data){
	    	console.log(data);
        },
	  });
	  
	});


	
	

</script>

<script type="text/javascript">


	$('#MyDepartment').click(function() {
	  var id_divisi = $('#MyDivisi').val();
	  var id_unit = $('#MyUnit').val();
	  var id_department = $('#MyDepartment').val();
	  $.ajax({
	    type:"POST",
	    url:"/get-section",
	    dataType: 'json',
	    data:{id_department:id_department,id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
	    beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
	    success: function(sections) {
	    	var html = '';
	    	$.each(sections.sections, function(key, value){	    		
	    		html += '<option value="'+value.id_section+'">'+value.nama_section+'</option>';
	    		
	    	});
	    	$('#MySection').html(html);	
	    	$('#Section').show();
	    	
	    	
	    },
	    error: function(data){
	    	console.log(data);
        },
	  });
	  
	});


	
	

</script>

<script>
  $(function () {
  
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
	   format: 'yyyy-mm-dd'
    });

  
  });
</script>


@endsection