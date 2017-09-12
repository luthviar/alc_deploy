@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<div class="col-md-12 ">
	<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">General info</a></li>
    <li role="presentation"><a href="#status" aria-controls="profile" role="tab" data-toggle="tab">Employee Status</a></li>
</div>
<br><br><br>
   <form id="myform" class="form-horizontal" role="form" method="POST" action="/personnel/submit">
    <div class="col-md-12 ">
	 <div class="tab-content">
	  <div role="tabpanel" class="tab-pane active" id="info">

        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>General Info</h4>
            </div>
            <div class="panel-body">
                
                    {{ csrf_field() }}
                
                <input type="hidden" class="form-control" name="id_personnel" value="{{$personnel->id}}" >

                <div class="form-group">
                    <label for="username" class="col-md-4 control-label">Username</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control" name="username" required autofocus value="{{$personnel['user']->username}}">
                    </div>
                </div>
					
				<div class="form-group">
                    <label for="fname" class="col-md-4 control-label">First Name</label>

                    <div class="col-md-6">
                        <input id="fname" type="text" class="form-control" name="fname"  required autofocus value="{{$personnel->fname}}">
                    </div>
                </div>
					
				<div class="form-group">
                    <label for="lname" class="col-md-4 control-label">Last Name</label>

                    <div class="col-md-6">
                        <input id="lname" type="text" class="form-control" name="lname"  required autofocus value="{{$personnel->lname}}">
                    </div>
                </div>

				<div class="form-group">
                    <label for="jenis_kelamin" class="col-md-4 control-label">Gender</label>                                     
                    <div class="col-md-6">
                        <select name="jenis_kelamin" class="form-control">
                            @if($personnel->jenis_kelamin ==1)
                            <option value="1" selected>Laki - Laki</option>
                            <option value="0">Perempuan</option>
                            @else
                            <option value="1">Laki - Laki</option>
                            <option value="0" selected>Perempuan</option>
                            @endif
                        </select><br>
                    </div>
                </div>
					
				<div class="form-group">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required value="{{$personnel->email}}">
                    </div>
                </div>
								
					
				<div class="form-group">
                    <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="text" class="form-control" name="no_hp" required value="{{$personnel->no_hp}}">
                    </div>
                </div>
					
				<div class="form-group">
                    <label for="datePicker" class="col-md-4 control-label">Birth Date</label>
                    <div class="col-md-6 date">
                        <div class="input-group input-append date" id="datePicker">
                            <input type="text" class="form-control" name="tanggal_lahir" value="{{$personnel->tanggal_lahir}}"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>

					
				<div class="form-group">
                    <label for="alamat" class="col-md-4 control-label">Adrress</label>

                    <div class="col-md-6">
						<textarea id="summernote" name="alamat">{{$personnel->alamat}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="is_admin" class="col-md-4 control-label">User Category</label>                                     
                    <div class="col-md-6">
                        <select name="is_admin" class="form-control">
                            @if($personnel['user']->is_admin == 1)
                            <option value="1" selected>Admin</option>
                            <option value="0">User</option>
                            @else
                            <option value="1">Admin</option>
                            <option value="0" selected>User</option>
                            @endif
                        </select><br>
                    </div>
                </div>


               </div>
			  </div>
            </div>
			
			<div role="tabpanel" class="tab-pane" id="status">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4>Employee status</h4>
					</div>
					<div class="panel-body">
						
						<div class="form-group">
                    <label for="nik" class="col-md-4 control-label">Employee Number</label>

                    <div class="col-md-6">
                        @if(empty($personnel['employee']) or empty($personnel['employee']->nip))
                        <input id="nik" type="text" class="form-control" name="nik" >
                        @else
                        <input id="nik" type="text" class="form-control" name="nik" value="{{$personnel['employee']->nip}}">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="level_position" class="col-md-4 control-label">Level Position</label>                                     
                    <div class="col-md-6">
                        <select name="level_position" class="form-control" id="level">
                        @if(empty($personnel['employee']))
							<option value="">.....</option>
                            @foreach($level as $pos)
                                <option value="{{$pos->id}}">{{$pos->nama_level}}</option>
                            @endforeach
                        @else
                            @foreach($level as $pos)
                                @if($pos->id == $personnel['level']->id)
                                    <option value="{{$pos->id}}" selected>{{$pos->nama_level}}</option>
                                @else
                                    <option value="{{$pos->id}}">{{$pos->nama_level}}</option>
                                @endif
                            @endforeach
                        @endif
                            
                        </select><br>
                    </div>
                </div>
                
                <div class="form-group" id="Divisi">
                    <label for="divisi" class="col-md-4 control-label">Divition</label>                                     
                    <div class="col-md-6">
                        <select name="divisi" class="form-control" id="MyDivisi">
                            @if(empty($personnel['struktur']) or empty($personnel['divisi']))
                                <option value="">..</option>
                                @foreach($divisi as $div)
                                <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                                @endforeach
                            @else
                                <option value="">..</option>
                                @foreach($divisi as $div)
                                    @if($div->id == $personnel['unit']->id)
                                    <option value="{{$div->id_divisi}}" selected>{{$div->nama_divisi}}</option>
                                    @else
                                        @foreach($divisi as $div)
                                        <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select><br>
                    </div>
                </div>
                <div class="form-group" id="Unit">
                    <label for="unit" class="col-md-4 control-label">Unit</label>                                     
                    <div class="col-md-6">
                        <select name="unit" class="form-control" id="MyUnit">
                            @if(empty($personnel['struktur']) or empty($personnel['unit']))
                                
                            @else
                                @foreach($unit as $unt)
                                    @if($unt->id == $personnel['unit']->id)
                                        <option value="{{$unt->id_unit}}" selected>{{$unt->nama_unit}}</option>
                                    
                                    @endif
                                @endforeach
                            @endif
                        </select><br>
                    </div>
                </div>
                <div class="form-group" id="Department">
                    <label for="department" class="col-md-4 control-label">Department</label>                                     
                    <div class="col-md-6">
                        <select name="department" class="form-control" id="MyDepartment">
                        @if(empty($personnel['struktur']) or empty($personnel['department']))
                            
                        @else
                            @foreach($department as $deps)
                                @if($deps->id == $personnel['department']->id)
                                    <option value="{{$deps->id_department}}" selected>{{$deps->nama_departmen}}</option>
                                @endif
                            @endforeach
                        @endif
                            
                        </select><br>
                    </div>
                </div>
                <div class="form-group" id="Section">
                    <label for="section" class="col-md-4 control-label">Section</label>                                     
                    <div class="col-md-6">
                        <select name="section" class="form-control" id="MySection">
                            @if(empty($personnel['struktur']) or empty($personnel['section']))
                                
                            @else
                                @foreach($section as $sect)
                                    @if($deps->id == $personnel['department']->id)
                                        <option value="{{$sect->id_section}}" selected>{{$sect->nama_section}}</option>
                                    
                                    @endif
                                @endforeach
                            @endif
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
									Edit User
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


@endsection

<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });


    
});
</script>
